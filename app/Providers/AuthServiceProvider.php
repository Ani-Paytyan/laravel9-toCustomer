<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Dto\IwmsApi\IwmsApiUserDto;
use App\Services\Auth\AuthService;
use App\Services\Auth\AuthServiceInterface;
use App\Services\Auth\UserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function register()
    {
        $this->app->singleton(AuthServiceInterface::class, AuthService::class);
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Auth::provider('iwms', function ($app, array $config) {
            return $app->make(\Illuminate\Contracts\Auth\UserProvider::class);
        });

        // employees
        Gate::define('invite-employee', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        Gate::define('edit-employee', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        Gate::define('destroy-employee', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        // workplaces
        Gate::define('create-workplace', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        Gate::define('edit-workplace', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        Gate::define('destroy-workplace', function (IwmsApiUserDto $user) {
            return $user->getRole() === IwmsApiUserDto::ROLE_SUPER_ADMIN
                || $user->getRole() === IwmsApiUserDto::ROLE_ADMIN;
        });

        // unique-items
        Gate::define('create-unique-items', function (IwmsApiUserDto $user) {
            return $user->getRole() !== IwmsApiUserDto::ROLE_WORKER;
        });

        Gate::define('destroy-unique-items', function (IwmsApiUserDto $user) {
            return $user->getRole() !== IwmsApiUserDto::ROLE_WORKER;
        });
    }
}
