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

    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        $remember = Session::get('remember');
        if ($admin_id){
            return Redirect::to('index');
        } else {
            return Redirect::to('login')->send();
        }
    }

    //login
    public function show() {
        return view('pages.login');
    }

    public function show_index() {
        //$this->AuthLogin();
        return view('index');
    }

    public function postLogin(Request $request) {
        $admin_account = $request->account;
        $admin_password = $request->password;
        $request->flashOnly('account');
        $result = DB::table('user')->where('UserAccount', $admin_account)->where('Password', $admin_password)->where('RoleID', 1)->first();
        if ($result) {
            Session::put('admin_name', $result->UserName);
            Session::put('admin_id', $result->UserID);
            Session::put('admin_image', $result->Image);
            return Redirect::to('index');
        } else {
            return redirect('/login')->withInput()->with('message', 'Incorrect acccount or password');
        }
    }

    //logout
    public function logout() {
        $this->AuthLogin();
        Session::put('admin_name', null);
        Session::put('admin_id', null);
        return Redirect::to('/login');
    }

}
