<?php

namespace App\Http\Controllers;

use App\Recipe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    /**
     * Adds a favourite.
     *
     * @return a json object
     */
    public function post(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $user = Auth::user();

        if(!$user->favourites()->whereId($id)->exists()){
            $user->favourites()->attach($id);   
        }

        foreach($user->favourites as $favourite){
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
