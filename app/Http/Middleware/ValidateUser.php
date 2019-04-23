<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateUser
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
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user){
            return response()->json([
                'message' => "We can't find a user with that e-mail address."
            ], 404);
        }

        $request->user = $user;

        return $next($request);
    }
}
