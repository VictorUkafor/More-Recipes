<?php

namespace App\Http\Middleware;

use App\Recipe;
use Closure;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class OwnRecipe
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
        $id = $request->route('id');
        $user_id = Auth::user()->id;
        $recipe = Recipe::find($id);
        
        if($recipe->user_id !== $user_id){
            return response()->json([
                'errorMessage' => 'Unauthorized action'
            ], 401);           
        }else{   
            return $next($request);           
        }
    }
}
