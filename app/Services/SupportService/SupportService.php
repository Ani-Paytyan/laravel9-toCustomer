<?php

namespace App\Services\SupportService;

use App\Dto\Support\SupportDto;
use Illuminate\Support\Facades\Config;
use Mail;

class SupportService implements SupportServiceInterface
{
    /**
     * @param $user
     * @param SupportDto $dto
     * @return void
     */
    public function send($user, SupportDto $dto): void
    {
        Mail::send('email.support', array(
            'firstName' => $user->getFirstName(),
            'lastName' => $user->getLastName(),
            'email' => $user->getEmail(),
            'company_name' => $user->getCompany()->getName(),
            'subject' => $dto->getSubject(),
            'support_text' => $dto->getSupportText(),
        ), static function($message) use ($dto){
            $message->from(Config::get('mail.from.support'));
            $message->to(Config::get('mail.from.support'))->subject($dto->getSubject());
        });
    }
}
