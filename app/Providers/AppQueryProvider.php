<?php

namespace App\Providers;

use App\Queries\Employee\EmployeeQuery;
use App\Queries\Employee\EmployeeQueryInterface;
use App\Queries\Team\TeamQuery;
use App\Queries\Team\TeamQueryInterface;
use App\Queries\UniqueItem\UniqueItemQuery;
use App\Queries\UniqueItem\UniqueItemQueryInterface;
use App\Queries\Workplace\WorkplaceQuery;
use App\Queries\Workplace\WorkplaceQueryInterface;
use Illuminate\Support\ServiceProvider;

class AppQueryProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(EmployeeQueryInterface::class, EmployeeQuery::class);
        $this->app->singleton(TeamQueryInterface::class, TeamQuery::class);
        $this->app->singleton(UniqueItemQueryInterface::class, UniqueItemQuery::class);
        $this->app->singleton(WorkplaceQueryInterface::class, WorkplaceQuery::class);
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
