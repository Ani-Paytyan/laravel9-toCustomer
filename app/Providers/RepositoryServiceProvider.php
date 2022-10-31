<?php

namespace App\Providers;

use App\Interfaces\WorkingDaysRepositoryInterface;
use App\Repositories\WorkingDaysRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(WorkingDaysRepositoryInterface::class, WorkingDaysRepository::class);
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
