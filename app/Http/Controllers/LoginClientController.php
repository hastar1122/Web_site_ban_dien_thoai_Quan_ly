<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class LoginClientController extends Controller
{
    public function index(Request $request)
    {
        $client_username = $request->username;
        $client_password = $request->password;
        $credentials = [
            'UserAccount' => $client_username,
            'password' => $client_password,
            'RoleID' => 4,
        ];
        //$check = DB::table('user')->where('UserAccount', $client_username)->where('RoleID', 4)->first();
        // if(Hash::check($client_password,$check->Password)) {
        //     return response()->json(null, 200);
        // } else {
        //     return response()->json(null, 400);
        // }
        if (Auth::attempt($credentials)) {
            return response()->json(null, 200);
        } else {
            return response()->json(null, 400);
        }
    }
}
