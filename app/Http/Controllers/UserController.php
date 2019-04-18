<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function signup(Request $request)
    {
        $token = Str::random(60);
        $user = new User;

        $user->first_name = $request->firstName;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->token = Hash::make($token);

        $user->save();

        // if($saved){
        //     return true;
        // } else {
        //     return false;
        // }
    }
}
