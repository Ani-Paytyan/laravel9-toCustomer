<?php

namespace App\Http\Middleware;


use App\Services\Auth\AuthService;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class SetIwmsApiToken extends AuthService
{
    /**
     * @return Application|RedirectResponse|Redirector|void
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Config::set('iwms.current_user_token', $this->getCurrentUser()->getToken());

            return $next($request);
        }

        return redirect('login');
    }
}
