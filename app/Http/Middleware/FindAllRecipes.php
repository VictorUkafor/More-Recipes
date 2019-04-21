<?php

namespace App\Http\Middleware;

use App\Recipe;
use Closure;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class FindAllRecipes
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
        $paginate = $request->query('paginate', 8);

        $recipes = Recipe::orderBy('id', 'desc')
        ->paginate($paginate);

        if(!$recipes || $recipes->total() === 0){
            return response()->json([
                'errorMessage' => 'No recipe found'
            ], 404);
        }
        else{   
            return $next($request);           
        }
    }
}
