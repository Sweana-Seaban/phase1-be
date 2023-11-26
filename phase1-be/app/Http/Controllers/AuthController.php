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
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'first_name' => $fields['first_name'],
            'last_name' => $fields['last_name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        //passing registered user information
        $response=[
            'user' => $user
        ];

        return response($response,201);
    }







    //added code
}
