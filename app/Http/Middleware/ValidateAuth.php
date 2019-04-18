<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateAuth
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
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|alpha_num',
            'confirmPassword' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        return $next($request);
    }    
    
    
    /**
 * Get custom attributes for validator errors.
 *
 * @return array
 */
public function attributes()
{
    return [
        'email' => 'email address',
        'firstName' => 'First Name'
    ];
}

}
