<?php

namespace App\Providers;

use App\Services\AdditionalWorkingDay\AdditionalWorkingDayService;
use App\Services\AdditionalWorkingDay\AdditionalWorkingDayServiceInterface;
use App\Services\Auth\UserProvider;
use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Item\ItemService;
use App\Services\Item\ItemServiceInterface;
use App\Services\Contact\ContactService;
use App\Services\Contact\ContactServiceInterface;
use App\Services\SupportService\SupportService;
use App\Services\SupportService\SupportServiceInterface;
use App\Services\TeamContact\TeamContactService;
use App\Services\TeamContact\TeamContactServiceInterface;
use App\Services\UniqueItem\UniqueItemService;
use App\Services\UniqueItem\UniqueItemServiceInterface;
use App\Services\Team\TeamService;
use App\Services\Team\TeamServiceInterface;
use App\Services\UniqueItemContact\UniqueItemContactService;
use App\Services\UniqueItemContact\UniqueItemContactServiceInterface;
use App\Services\WorkDays\WorkDaysService;
use App\Services\WorkDays\WorkDaysServiceInterface;
use App\Services\WorkPlace\WorkPlaceService;
use App\Services\WorkPlace\WorkPlaceServiceInterface;
use App\Services\WorkPlaceContact\WorkPlaceContactService;
use App\Services\WorkPlaceContact\WorkPlaceContactServiceInterface;
use Illuminate\Contracts\Auth\UserProvider as UserProviderInterface;
use Illuminate\Pagination\Paginator;
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
        $this->app->singleton(AdditionalWorkingDayServiceInterface::class, AdditionalWorkingDayService::class);
        $this->app->singleton(ContactServiceInterface::class, ContactService::class);
        $this->app->singleton(CompanyServiceInterface::class, CompanyService::class);
        $this->app->singleton(ItemServiceInterface::class, ItemService::class);
        $this->app->singleton(UserProviderInterface::class, UserProvider::class);
        $this->app->singleton(UniqueItemServiceInterface::class, UniqueItemService::class);
        $this->app->singleton(UniqueItemContactServiceInterface::class, UniqueItemContactService::class);
        $this->app->singleton(WorkPlaceServiceInterface::class, WorkPlaceService::class);
        $this->app->singleton(WorkPlaceContactServiceInterface::class, WorkPlaceContactService::class);
        $this->app->singleton(TeamServiceInterface::class, TeamService::class);
        $this->app->singleton(TeamContactServiceInterface::class, TeamContactService::class);
        $this->app->singleton(WorkDaysServiceInterface::class, WorkDaysService::class);
        $this->app->singleton(SupportServiceInterface::class, SupportService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFour();
    }
}
