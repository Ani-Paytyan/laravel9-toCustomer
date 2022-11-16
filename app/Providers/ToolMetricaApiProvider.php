<?php

namespace App\Providers;

use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemService;
use App\Services\ToolMetricaApi\UniqueItem\ToolMetricaApiUniqueItemServiceInterface;
use Illuminate\Support\ServiceProvider;

class ToolMetricaApiProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ToolMetricaApiUniqueItemServiceInterface::class, ToolMetricaApiUniqueItemService::class);
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
