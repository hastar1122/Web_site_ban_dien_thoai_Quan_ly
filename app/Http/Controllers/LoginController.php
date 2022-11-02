<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
session_start();

class LoginController extends Controller
{

    public function username()
    {
        return 'UserAccount';
    }

    //login
    public function show() {
        return view('pages.login');
    }

    public function show_index() {
        if(Auth::check())
            return view('index');
        else
            return view('pages.login');
    }

    public function postLogin(Request $request) {

        $admin_account = $request->account;
        $admin_password = $request->password;
        $credentials = [
            'UserAccount' => $request['account'],
            'password' => $request['password'],
            'RoleID' => 1,
        ];
        //$remember = $request->has('remember') ? true:false;

        if (Auth::attempt($credentials)) {
            return Redirect::to('index');
        } else {
            return redirect('/login')->withInput()->with('message', 'Incorrect acccount or password');
        }
    }

    //logout
    public function logout() {
        Auth::logout();
        return Redirect::to('/login');
    }

}
