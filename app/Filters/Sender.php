<?php

namespace App\Filters;

use Closure;

class Sender
{
    public function handle($request, Closure $next)
    {
        if (! request()->filled('search')) {
            return $next($request);
        }

        return $next($request)->whereLike('sender', request()->search);
    }
}
