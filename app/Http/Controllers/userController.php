<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class userController extends Controller
{

    public function register(Request $request)
    {
        $fields = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:100',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'no_hp' => 'required|string|max:100'
        ]);

    

        $user = User::create([
            'nama' => $fields['nama'],
            'username' => $fields['username'],
            'email'=> $fields['email'],
            'password' => bcrypt($fields['password']),
            'no_hp' => $fields['no_hp']
        ]);

        $token = $user->createToken('MyToken', ['user'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {
     $fields = $request->validate([
         'email' => 'required|string',
         'password' => 'required|string'
     ]);

     //check email
    $user = user::where('email', $fields['email'])->first();

    $token = $user->createToken('tokenku')->plainTextToken;

$response = [
    'user' => $user,
    'token' => $token
];

return response($response, 201);


    }

    public function logout(Request $request)
    {
     $request->user()->currentAccessToken()->delete();

    return [
        'message' => 'User berhasil logout'
    ];
    }

   
    
}