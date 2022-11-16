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
    private ?string $token = null;

    public function setToken(?string $token): static
    {
        $this->token = $token;
        return $this;
    }

    protected function getToken(): ?string
    {
        if (empty($this->token)) {
            $this->setToken(Config::get('toolmetrica.current_token'));
        }

        return $this->token;
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

        if ($this->getToken()) {
            $headers['apikey'] = $this->getToken();
        }

        $request->withHeaders($headers);

        return $request;
    }

    protected function handleError(Response $response)
    {
        if (!$response->successful()) {
            $message = $response->json()['error'] ?? '';

            throw new ToolMetricaApiError($message, $response->status());
        }
    }
}
