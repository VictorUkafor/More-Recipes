<?php

namespace App\Http\Controllers;

use App\Reaction;
use App\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReactionController extends Controller
{
    /**
     * makes a reaction.
     *
     * @return a json object
     */
    public function post(Request $request, $id)
    {
        $recipe = Recipe::find($id);
        $user_id = Auth::user()->id;
        $vote = $request->query('vote');

        if($vote != 1 && $vote != -1){
            $vote = 0;
        } 

        $reaction = Reaction::where([
            'recipe_id' => $id,
            'user_id' => $user_id
        ])->first();

        if(!$reaction){
            $reaction = new Reaction;
        } 

        $reaction->recipe_id = $id;
        $reaction->user_id = $user_id;
        $reaction->vote = $vote;
        
        if ($reaction->save()) {            
            
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
