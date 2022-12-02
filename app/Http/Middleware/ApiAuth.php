<?php

namespace App\Http\Middleware;

use App\Models\AccessTokens;
use App\Services\Auth\AuthServiceInterface;
use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ApiAuth
{
    public function __construct(
        private AuthServiceInterface $authService
    )
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token || !$user = $this->authService->getUserByApiToken($token)) {
            throw new AuthenticationException();
        }

        Auth::setUser($user);
        AccessTokens::where('token', '=' , $token)->first()->update(['last_use_at', now()]);
        Config::set('iwms.current_user_token', $user->getToken());

        return $next($request);
    }
}
