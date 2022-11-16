<?php

namespace App\Http\Controllers;

use App\Http\Requests\Support\SupportRequest;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Mail;

class SupportController extends Controller
{
    protected $user;

    public function __construct(
        protected IwmsApiContactServiceInterface $apiContactService,
    )
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

    public function send(SupportRequest $request)
    {
        try {
            //  Send mail to support
            Mail::send('email.support', array(
                'firstName' => $this->user->getFirstName(),
                'lastName' => $this->user->getLastName(),
                'email' => $this->user->getEmail(),
                'company_name' => $this->user->getCompany()->getName(),
                'subject' => $request->get('subject'),
                'support_text' => $request->get('support_text'),
            ), static function($message) use ($request){
                $message->from(Config::get('mail.from.support'));
                $message->to(Config::get('mail.from.support'))->subject($request->get('subject'));
            });

            return response()->json([
                'data' => [],
                'status' => 'success',
                'message' => __('page.support.message_sent')
            ]);
        } catch (Exception $e) {
            return response()->json([
                'data' => [],
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
