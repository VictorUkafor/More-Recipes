<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserExist
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
