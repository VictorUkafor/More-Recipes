<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get(
//     '/user',
//     function (Request $request) {
//         return $request->user();
//     }
// );


Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {

        // signup route
        Route::post('signup', 'UserController@signup')->middleware('validateSignup');

        // login route
        Route::post('login', 'UserController@login')->middleware('validateLogin');

        //user details route
        Route::get('user', 'UserController@details')->middleware('auth:api');
    });

    // recipes
    Route::prefix('recipes')->group(function () {
        Route::middleware(['auth:api'])->group(function () {
            
            // saves a recipe
            Route::post('/', 'RecipeController@store')->middleware('validateNewRecipe');
        });
    });
});
