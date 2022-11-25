<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Language
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = Session()->get('applocale');
        if (!empty($locale) AND array_key_exists($locale, config('languages'))) {
            App::setLocale($locale);
        }
        return $next($request);
    }
}
