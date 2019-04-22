<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Reaction;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * stores a recipe to the database.
     *
     * @return a json object
     */
    public function store(Request $request)
    {
        $image_public_id = str_replace(' ', '', $request->name);
        $image_name = $request->image->getRealPath();

        $recipe = new Recipe;
        
        $recipe->user_id = Auth::user()->id;
        $recipe->name = $request->name;
        $recipe->ingredients = $request->ingredients;
        $recipe->method = $request->method;
        $recipe->image = $image_public_id;

        // uploads image to cloudinary
        $upload = Cloudder::upload($image_name, $image_public_id);

        if ($upload && $recipe->save()) {
            // insert upvotes and downvotes into recipe
            $recipe->upvotes = $recipe->reactions()->where('vote', 1)->count();
            $recipe->downvotes = $recipe->reactions()->where('vote', -1)->count();

            return response()->json([
                'successMessage' => 'Recipe uploaded successfully',
                'recipe' => $recipe
            ], 201);
        } else {
            return response()->json([
                'errorMessage' => 'Internal server error'], 500);
        }
    }


    /**
     * display all recipes.
     *
     * @return a json object
     */
    public function showAll(Request $request)
    {
        $paginate = $request->query('paginate', 8);
        $upvote = $request->query('sort');        
        
        // sort recipes result by id
        $recipes = Recipe::orderBy('id', 'desc')
        ->paginate($paginate);

        // sort recipes result by upvote count 
        // if query sort=vote is set
        if($upvote && $upvote === 'upvote'){
            $recipes = Recipe::withCount(['reactions' => function ($query) {
                $query->where('vote', 1);
            }])
            ->latest('reactions_count')
            ->paginate($paginate);
        }
        
        foreach ($recipes as $recipe) {
            // insert upvotes and downvotes into recipe
            $recipe->upvotes = $recipe->reactions()->where('vote', 1)->count();
            $recipe->downvotes = $recipe->reactions()->where('vote', -1)->count();
        }
        
        return response()->json([
                'recipes' => $recipes
            ], 200);
        
        }

    /**
     * display a single recipe
     *
     * @return a json object
     */
    public function show(Request $request, $recipeId)
    {
        
        $recipe = Recipe::find($recipeId);

        // insert upvotes and downvotes into recipe
        $recipe->upvotes = $recipe->reactions()->where('vote', 1)->count();
        $recipe->downvotes = $recipe->reactions()->where('vote', -1)->count();
        
        return response()->json([
            'recipe' => $recipe
        ], 200);  

    }


    /**
     * updates a single recipe
     *
     * @return a json object
     */
    public function update(Request $request, $recipeId)
    {
        // get public id of saved recipe image
        $old_image = Recipe::find($recipeId)->image; 
                
        // get the RealPath of new recipe image
        $image_name = $request->image ? 
        $request->image->getRealPath() : '';  
        
        // get recipe name to be saved
        $filename = $request->name ? 
        $request->name : $recipe->name;
        
        // get public id to be saved
        $image_public_id = $request->image ? 
        str_replace(' ', '', $filename) : $recipe->image; 

        // updates record
        $recipe->name = $filename;

        $recipe->ingredients = $request->ingredients ?
         $request->ingredients : $recipe->ingredients;

        $recipe->method = $request->method ?
         $request->method : $recipe->method;

        $recipe->image = $image_public_id;

            // if an image is uploaded, save to cloudinary
            // and deletes the previous one
            if(strlen($image_name) !== 0){
              Cloudder::upload($image_name, $image_public_id); 
              Cloudder::delete($old_image); 
            }        
            
            if ($recipe->save()) {
                // insert upvotes and downvotes into recipe
                $recipe->upvotes = $recipe->reactions()->where('vote', 1)->count();
                $recipe->downvotes = $recipe->reactions()->where('vote', -1)->count();

                return response()->json([
                    'successMessage' => 'Recipe updated successfully',
                    'recipe' => $recipe
                ], 201);
            } else {
                return response()->json([
                    'errorMessage' => 'Internal server error'
                ], 500);
            }

      }


    /**
     * soft deletes a recipes
     *
     * @return a json object
     */
    public function softDelete(Request $request, $recipeId)
    {
        $softDelete = Recipe::destroy($recipeId);

        if($softDelete){ 
            return response()->json([
                'success' => 'Recipe deleted successfully'
            ], 200);  
        }else{            
            return response()->json([
                'errorMessage' => 'Internal server error'
            ], 500);
        }

    }

}
