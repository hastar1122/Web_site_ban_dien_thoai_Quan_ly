<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class LoginController extends Controller
{
    public function login() {
        return view('pages.login');
    }

    // public function postAuthLogin(Request $request) {
    //     $acc = [
    //         'UserAccount' => $request->$UserAccount,
    //          'Password' => $request->$Password
    //     ];

    //     if (Auth::attempt($acc)) {

    //     } else {

    //     }
    // }
}
