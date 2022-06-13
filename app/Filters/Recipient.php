<?php

namespace App\Filters;

use Closure;

class Recipient
{
    public function handle($request, Closure $next)
    {
        if (! request()->filled('search')) {
            return $next($request);
        }

        return $next($request)->whereLike('recipient', request()->search);
    }
}
