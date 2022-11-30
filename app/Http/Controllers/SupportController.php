<?php

namespace App\Http\Controllers;

use App\Dto\Support\SupportDto;
use App\Http\Requests\Support\SupportRequest;
use App\Services\IwmsApi\Contact\IwmsApiContactServiceInterface;
use App\Services\SupportService\SupportServiceInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

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

    public function send(SupportRequest $request, SupportServiceInterface $supportService): ?JsonResponse
    {
        $dto = SupportDto::createFromRequest($request);

        try {
            //  Send mail to support
            $supportService->send($this->user, $dto);

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
