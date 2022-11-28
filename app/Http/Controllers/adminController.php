<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
   public function register(Request $request)
   {
    $fields = $request->validate([
        'nama' => 'required|string|max:100',
        'username' => 'required|string|max:100',
        'password'=> 'required|string|confirmed|min:6',
        'email' => 'required|string|unique:users,email',
        'no_hp' => 'required|string'
    ]);

    $user = user::create([
        'nama' => $fields['nama'],
        'username' => $fields['username'],
        'email' => $fields['email'],
        'password' => bcrypt($fields['password']),
        'no_hp' => $fields['no_hp']
    ]);

    $token = $user->createToken('tokenku')->plainTextToken;

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

    //password
    if (!$user || !Hash::check($fields['password'], $user->password))
    return response([
        'message' => 'unauthorized'
    ], 401);


$token = $user->createToken('tokenku')->plainTextToken;

$response = [
    'user' => $user,
    'token' => $token
];

return response($response, 201);


}


public function logout(Request $request){
    $request->user()->currentAccessToken()->delete();

    return [
        'message' => 'Admin berhasil logout'
    ];

}

    public function destroy($id)
    {
        $admin = admin::where('id', $id)->first();
        if($admin){
            $tiket->delete();
            return response()->json([
                'status' => 200,
                'message' => "Admin Berhasil Dihapus"
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Admin Tidak Dapat Ditemukan"
            ], 404);
        }
    }
}
