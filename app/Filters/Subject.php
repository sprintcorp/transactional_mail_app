<?php

namespace App\Filters;

use Closure;

class Subject
{
    public function handle($request, Closure $next)
    {
        if (! request()->filled('search')) {
            return $next($request);
        }

        return $next($request)->whereLike('subject', request()->search);
    }
}
