<?php
namespace App\Console\Commands;

use App\Exceptions\Iwms\IwmsApiError;
use App\Models\Company;
use App\Services\Contact\ContactServiceInterface;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;

class IwmsSyncContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:contacts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sync contacts(employees) from the IWMS';


    /**
     * @param IwmsApiContactServiceInterface $apiService
     * @param ContactServiceInterface $contactService
     * @return void
     */
    public function handle(IwmsApiContactServiceInterface $apiService, ContactServiceInterface $contactService): void
    {
        // set token
        $apiService->setUserToken(Config::get('iwms.root_token'));
        // sync contacts
        try {
            $this->info('start updating contacts...');
            $contactService->sync($this->getContactsWithPagination($apiService));
            $this->info('finish updating contacts...');
        }  catch (\Exception $e) {
            Log::error('Sync contacts : ' .  $e->getMessage());
        }
    }

    /**
     * @param IwmsApiContactServiceInterface $apiService
     * @return array
     */
    public function getContactsWithPagination(IwmsApiContactServiceInterface $apiService): array
    {
        // get all companies
        $companies = Company::pluck('uuid');
        $contacts = [];
        // get contacts
        foreach ($companies as $company) {
            try {
                $result = $apiService->getContacts($company, 1);
                if ($result) {
                    $pageCount = $result->getTotalPages();
                    $contacts[] = $result->getResults();

                    if ($pageCount > 1) {
                        for ($i = 2; $i <= $pageCount; $i++) {
                            $resultOtherPages = $apiService->getContacts($company, $i);
                            if ($resultOtherPages) {
                                $contacts[] = $resultOtherPages->getResults();
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                if (get_class($e) === IwmsApiError::class) {
                    Log::error("IwmsSyncContacts - Code: " . $e->getCode() . " File:" . $e->getFile() .  " Message: " . $e->getMessage());
                    $this->error($e->getMessage());
                } else {
                    throw $e;
                }
            }
        }

        return array_merge([], ...$contacts);
    }
}
