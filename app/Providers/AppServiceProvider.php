<?php

namespace App\Providers;

use App\Services\Auth\UserProvider;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(CompanyServiceInterface::class, CompanyService::class);
        $this->app->singleton(UserProviderInterface::class, UserProvider::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
