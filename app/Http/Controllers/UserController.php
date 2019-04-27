<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @resource User
 *
 * This Controller handles all user related logic and methods
 */
class UserController extends Controller
{
    /**
     * sign up a user.
     * 
     * @param  [string] first_name
     * @param  [string] last_name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @return [json] user
     */
    public function signup(Request $request)
    {
        $user = new User;

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        
        if ($user->save()) {
            $token = $user->createToken('authToken')->accessToken;
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201); 

        } else {
            return response()->json([
                'errorMessage' => 'Internal server error'
            ], 500);
        }
    }

    /**
     * login a user.
     * 
     * @param  [string] email
     * @param  [string] password
     * @return [json] user
     */
    public function login(Request $request)
    {
        // tries to authenticate user
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
            ])) {

            // sets auth user and creates token
            $user = Auth::user();
            $token =  $user->createToken('authToken')->accessToken;
            
            // when auth user and token can't be created
            if (!$user || !$token) {
                return response()->json([
                    'errorMessage' => 'Internal server error'
                ], 500);
            }

            // return user and token after 
            // sucessfull authentication
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 201); 

        } else {

            // when authentication fails
            return response()->json([
                'errorMessage' => 'Invalid email or password'
            ], 401);
        }
    }


    /**
     * details api
     * 
     * @return [json] user
     */
    public function details(Request $request)
    {
        $user = Auth::user();

        foreach($user->favourites as $favourite){
            // foreach favourite recipe get votes
            // and insert into user
            $recipe = Recipe::find($favourite->id);
            $favourite->upvotes = $recipe->reactions()->where('vote', 1)->count();
            $favourite->downvotes = $recipe->reactions()->where('vote', -1)->count();  
        }

        return (new UserResource($user))
        ->response()
        ->setStatusCode(200);
    }
}
