<?php

namespace App\Services\ToolMetricaApi;

use App\Exceptions\ToolMetrica\ToolMetricaApiError;
use GuzzleHttp\Middleware;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractToolMetricaApi
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
            $this->setUserToken(Config::get('toolmetrica.current_user_token'));
        }

        return $this->userToken;
    }

    protected function getRequestBuilder(): PendingRequest
    {
        $request = Http::baseUrl(config('toolmetrica.api_base_url'));

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

            throw new ToolMetricaApiError($message, $response->status());
        }
    }
}
