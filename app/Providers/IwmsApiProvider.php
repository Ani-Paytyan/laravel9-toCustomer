<?php

namespace App\Providers;

use App\Services\IwmsApi\Auth\IwmsApiAuthService;
use App\Services\IwmsApi\Auth\IwmsApiAuthServiceInterface;
use App\Services\IwmsApi\Company\IwmsApiCompanyService;
use App\Services\IwmsApi\Company\IwmsApiCompanyServiceInterface;
use App\Services\IwmsApi\Contact\IwmsApiContactService;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceService;
use App\Services\IwmsApi\WorkPlace\IwmsApiWorkPlaceServiceInterface;
use Illuminate\Support\ServiceProvider;

class IwmsApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IwmsApiAuthServiceInterface::class, IwmsApiAuthService::class);
        $this->app->singleton(IwmsApiContactServiceInterface::class, IwmsApiContactService::class);
        $this->app->singleton(IwmsApiCompanyServiceInterface::class, IwmsApiCompanyService::class);
        $this->app->singleton(IwmsApiWorkPlaceServiceInterface::class, IwmsApiWorkPlaceService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
