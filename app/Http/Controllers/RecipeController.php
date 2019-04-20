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

        $upload = Cloudder::upload($image_name, $image_public_id);

        if ($upload && $recipe->save()) {
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
        $recipes = Recipe::orderBy('id', 'desc')
        ->paginate($paginate);

        if(!$recipes || $recipes->total() === 0){            
            return response()->json([
                'errorMessage' => 'No recipes found'
            ], 404);
        }else{            
            return response()->json([
                'recipes' => $recipes
            ], 200);
        }

    }


    /**
     * display a single recipe
     *
     * @return a json object
     */
    public function show(Request $request, $id)
    {
        $recipe = Recipe::find($id);

        if($recipe){             
            return response()->json([
                'recipe' => $recipe
            ], 200);  
        }else{            
            return response()->json([
                'errorMessage' => 'Recipe not found'
            ], 404);
        }

    }


    /**
     * updates a single recipe
     *
     * @return a json object
     */
    public function update(Request $request, $id)
    {
        $old_image = Recipe::find($id)->image; 
                
        $image_name = $request->image ? $request->image->getRealPath() : '';  
        
        $filename = $request->name ? $request->name : $recipe->name;
        
        $image_public_id = $request->image ? str_replace(' ', '', $filename) : $recipe->image; 

        $recipe->name = $filename;

        $recipe->ingredients = $request->ingredients ?
         $request->ingredients : $recipe->ingredients;

        $recipe->method = $request->method ?
         $request->method : $recipe->method;

        $recipe->image = $image_public_id;

            if(strlen($image_name) !== 0){
              Cloudder::upload($image_name, $image_public_id); 
              Cloudder::delete($old_image); 
            }        
            
            if ($recipe->save()) {
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
    public function softDelete(Request $request, $id)
    {
        $softDelete = Recipe::destroy($id);

        if($softDelete){ 
            return response()->json([
                'success' => 'Recipe deleted successfully'
            ], 200);  
        }else{            
            return response()->json([
                'errorMessage' => 'recipe not found'
            ], 404);
        }

    }

    }
