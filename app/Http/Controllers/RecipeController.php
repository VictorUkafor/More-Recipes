<?php

namespace App\Http\Controllers;

use App\Recipe;
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
        $user_id = Auth::user()->id;
        $image_public_id = str_replace(' ', '', $request->name);
        $image_name = $request->image->getRealPath();

        $recipe = new Recipe;
        
        $recipe->user_id = $user_id;
        $recipe->name = $request->name;
        $recipe->ingredients = $request->ingredients;
        $recipe->method = $request->method;
        $recipe->image = $image_public_id;

        if ($recipe->save()) {
            Cloudder::upload($image_name, $image_public_id);
            return response()->json([
                'successMessage' => 'Recipe uploaded successfully',
                'recipe' => $recipe
            ], 201);
        } else {
            return response()->json([
                'errorMessage' => 'Internal server error'], 500);
        }
    }
}
