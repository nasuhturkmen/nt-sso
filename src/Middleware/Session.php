<?php

namespace NasuhTurkmen\Admin\Middleware;

use Illuminate\Http\Request;

class Session
{
    public function handle(Request $request, \Closure $next)
    {
        $path = '/'.trim(config('sso.route.prefix'), '/');

        config(['session.path' => $path]);

        if ($domain = config('sso.route.domain')) {
            config(['session.domain' => $domain]);
        }

        return $next($request);
    }
}
