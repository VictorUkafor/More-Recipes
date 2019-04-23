<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * @resource Favourite
 *
 * This Controller handles all favourite related logic and methods
 */
class FavouriteController extends Controller
{
    /**
     * Adds a favourite.
     * 
     * @param  [integer] recipe id
     * @return [string] message
     * @return [json] recipe
     */
    public function post(Request $request, $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $user = Auth::user();

        // if relationship does not exist creates one
        if(!$user->favourites()->whereId($recipeId)->exists()){
            $user->favourites()->attach($recipeId);   
        }

        foreach($user->favourites as $favourite){
            // insert upvotes and downvotes into recipe
            $favourite->upvotes = $recipe->reactions()->where('vote', 1)->count();
            $favourite->downvotes = $recipe->reactions()->where('vote', -1)->count();
        }
  
        if ($user) {
            return response()->json([
                'successMessage' => 'Favourite added successfully',
                'user' => $user,
            ], 201);
        } else {
            return response()->json([
                'errorMessage' => 'Internal server error'], 500);
        }
    }
}
