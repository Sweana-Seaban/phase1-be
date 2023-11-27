<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//added code
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
//added code

class AuthController extends Controller
{
    //added code
    
    //register function

    public function register(Request $request){
        $fields=$request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'username' => $fields['username'],
            'password' => bcrypt($fields['password'])
        ]);

        //passing registered user information
        $response=[
            'user' => $user
        ];

        return response($response,201);
    }

    //login function
    public function login(Request $request){
        $fields=$request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        //check username
        $user = User::where('username',$fields['username'])->first();

        //check password
        if( !$user || !Hash::check($fields['password'],$user->password)){
            return response([
                'message' => 'Invalid Credentials'
            ],401);
        }

        //create token
        $token = $user->createToken('usertoken')->plainTextToken;

        //passing user information
        $response=[
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }

    //logout function
    public function logout(Request $request){
        auth()->user()->tokens()->delete();

        return[
            'message' => 'Logged out'
        ];
    }



    //added code
}
