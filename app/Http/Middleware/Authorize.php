<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class Authorize
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
        $authorization = $request->header('authorization');

        if (!$authorization || $authorization === '') {
            return response()->json([
                'errorMessage' => 'Please login'
            ], 401);
        }

        return $next($request);
    }
}
