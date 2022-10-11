<?php

namespace App\Http\Middleware;


use App\Services\Auth\AuthService;
use Closure;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class IwmsAuth extends AuthService
{
    /**
     * @return Application|RedirectResponse|Redirector|void
     */
    public function handle($request, Closure $next)
    {
        $currentUser = $this->getCurrentUser();

        if ($currentUser && $currentUser->getToken()){
            return $next($request);
        }

        return redirect('login');
    }
}
