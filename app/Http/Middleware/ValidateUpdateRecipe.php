<?php

namespace App\Http\Middleware;

use Closure;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ValidateUpdateRecipe
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
            'name' => 'unique:recipes,name',
            'image' => 'image|dimensions:width=225,height=191'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors, 400);
        }

        return $next($request);
    }
}
