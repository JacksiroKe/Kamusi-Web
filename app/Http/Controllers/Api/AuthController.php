<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|max:50',
                'dobirth' => 'required|max:12',
                'gender' => 'required|max:1',
                'about' => 'required|max:2000',
                'town' => 'required|max:20',
                'country' => 'required|max:3',
                'email' => 'email|required|unique:users',
                'password' => 'required|confirmed'
            ]);

            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            $accessToken = $user->createToken('authToken')->accessToken;

            return response([ 
                'status' => 1,
                'user' => $user, 
                'access_token' => $accessToken, 
                'message' => 'User registered successfully'
            ]);
        } catch (\Exception $e) {

            return response([ 
                'status' => 0,
                'message' => $e->getMessage()
            ]);
        }
        
    }

    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response([
                'status' => 0,
                'message' => 'Invalid Credentials'
            ]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;

        return response([
            'status' => 1,
            'user' => auth()->user(),
            'access_token' => $accessToken,
            'message' => 'User logged in successfully'
        ]);

    }
}
