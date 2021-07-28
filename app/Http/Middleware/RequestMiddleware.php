<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequestMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');

        if($request->header('content-type') === 'application/json'){
            return $next($request);
        }
        return response('', 415);
    }
}
