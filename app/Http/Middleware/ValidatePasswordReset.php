<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidatePasswordReset
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
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|min:7|alpha_num|confirmed',
            'password_confirmation' => 'required|same:password',
            'token' => 'required|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        return $next($request);
    }
}
