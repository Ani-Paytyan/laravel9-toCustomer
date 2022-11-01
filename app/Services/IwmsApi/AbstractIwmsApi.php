<?php

namespace App\Services\IwmsApi;

use App\Exceptions\Iwms\IwmsApiError;
use GuzzleHttp\Middleware;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;
use Illuminate\Support\Facades\Config;

abstract class AbstractIwmsApi
{
    private ?string $userToken = null;

    public function setUserToken(?string $token): static
    {
        $this->userToken = $token;
        return $this;
    }

    protected function getUserToken(): ?string
    {
        if (empty($this->userToken)) {
            $this->setUserToken(Config::get('iwms.current_user_token'));
        }

        return $this->userToken;
    }

    protected function getRequestBuilder(): PendingRequest
    {
        $request = Http::baseUrl(config('iwms.api_base_url'));

        $request->withMiddleware(
            Middleware::mapResponse(function (ResponseInterface $response) {
                $this->handleError(new Response($response));

                return $response;
            })
        );

        $headers = [
            'Accept' => 'application/json',
        ];

        if ($this->getUserToken()) {
            $headers['Authorization'] = 'Bearer ' . $this->getUserToken();
        }

        $request->withHeaders($headers);

        return $request;
    }

    protected function handleError(Response $response)
    {
        if (!$response->successful()) {
            $message = $response->json()['errors'] ? implode(' ', $response->json()['errors']) : [];

            throw new IwmsApiError($message, $response->status());
        }
    }
}
