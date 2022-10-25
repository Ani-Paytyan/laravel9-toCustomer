<?php

namespace App\Providers;

use App\Services\Auth\UserProvider;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Contact\ContactService;
use App\Services\Contact\ContactServiceInterface;
use App\Services\Team\TeamService;
use App\Services\Team\TeamServiceInterface;
use App\Services\WorkPlace\WorkPlaceService;
use App\Services\WorkPlace\WorkPlaceServiceInterface;
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
        $this->app->singleton(ContactServiceInterface::class, ContactService::class);
        $this->app->singleton(CompanyServiceInterface::class, CompanyService::class);
        $this->app->singleton(UserProviderInterface::class, UserProvider::class);
        $this->app->singleton(WorkPlaceServiceInterface::class, WorkPlaceService::class);
        $this->app->singleton(TeamServiceInterface::class, TeamService::class);
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
