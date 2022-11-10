<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class LoginController extends Controller
{

    public function username()
    {
        return 'UserAccount';
    }

    //login
    public function show() {
        return view('admin.pages.login');
    }

    public function show_index() {
        if(Auth::check())
            return view('admin.index');
        else
            return view('admin.pages.login');
    }

    public function postLogin(Request $request) {
        $admin = [
            'UserAccount' => $request['account'],
            'password' => $request['password'],
            'RoleID' => 1,
        ];

        $customer = [
            'UserAccount' => $request['username'],
            'password' => $request['password1'],
            'RoleID' => 4,
        ];
        if (Auth::attempt($admin)) {
            return Redirect::to('index');
        } else if (Auth::attempt($customer)){
            return Redirect::to('logClient');
        } else if (!$request['account']) {
            return response()->json(null, 400);
        } else if (!$request['username']) {
            return redirect()->back()->withInput()->with('message', 'Sai tên tài khoản hoặc mật khẩu');
        }
    }

    //logout
    public function logout() {
        Auth::logout();
        return Redirect::to('/login');
    }

    public function logoutClient() {
        Auth::logout();
        return Redirect::to('/showClient');
    }

}
