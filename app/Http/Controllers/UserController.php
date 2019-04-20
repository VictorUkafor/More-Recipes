<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * sign up a user.
     *
     * @return a json object
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
                'errorMessage' => 'Internal server error'], 500);
        }
    }

    /**
     * login a user.
     *
     * @return a json object
     */
    public function login(Request $request)
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
            ])) {
            $user = Auth::user();
            $token =  $user->createToken('authToken')->accessToken;
            if (!$user || !$token) {
                return response()->json([
                    'errorMessage' => 'Internal server error'
                ], 500);
            }
            return response()->json([
                'user' => $user, 'token' => $token
            ], 201);
        } else {
            return response()->json([
                'errorMessage' => 'Invalid email or password'
            ], 401);
        }
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details(Request $request)
    {
        $user = Auth::user();
        return response()->json(['user' => $user], 200);
    }
}
