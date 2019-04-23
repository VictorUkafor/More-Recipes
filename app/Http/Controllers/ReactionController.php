<?php

namespace App\Http\Controllers;

use App\Reaction;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @resource Reaction
 *
 * This Controller handles all reaction related logic and methods
 */
class ReactionController extends Controller
{
    /**
     * makes a reaction.
     * 
     * @param  [integer] recipe id
     * @param  [string] vote
     * @return [string] message
     * @return [json] recipe
     */
    public function post(Request $request, $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        $user_id = Auth::user()->id;
        $vote = $request->query('vote');

        // sets query vote to zero when it is
        // neither 1 or -1
        if($vote != 1 && $vote != -1){
            $vote = 0;
        } 

        $reaction = Reaction::where([
            'recipe_id' => $recipeId,
            'user_id' => $user_id
        ])->first();

        // create new reaction when reaction 
        // does not exist
        if(!$reaction){
            $reaction = new Reaction;
        } 

        $reaction->recipe_id = $recipeId;
        $reaction->user_id = $user_id;
        $reaction->vote = $vote;
        
        if ($reaction->save()) {            
            // insert upvotes and downvotes into recipe
            $recipe->upvotes = $recipe->reactions()->where('vote', 1)->count();
            $recipe->downvotes = $recipe->reactions()->where('vote', -1)->count();

            return response()->json([
                'successMessage' => 'Reaction added successfully',
                'recipe' => $recipe,
            ], 201);

            } 
            else {   

                return response()->json([
                    'errorMessage' => 'Internal server error'
                ], 500);
            }

    }

}
