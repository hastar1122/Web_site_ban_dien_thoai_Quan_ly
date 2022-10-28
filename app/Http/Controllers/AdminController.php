<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;
session_start();

class AdminController extends Controller
{

    public function AuthLogin() {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('index');
        } else {
            return Redirect::to('login')->send();
        }
    }

    //login
    public function login() {
        return view('pages.login');
    }

    public function show_index() {
        $this->AuthLogin();
        return view('index');
    }

    public function admin_index(Request $request) {
        $admin_account = $request->admin_account;
        $admin_password = $request->admin_password;

        $result = DB::table('user')->where('UserAccount', $admin_account)->where('Password', $admin_password)->where('RoleID', 1)->first();
        if ($result) {
            Session::put('admin_name', $result->UserName);
            Session::put('admin_id', $result->UserID);
            return Redirect::to('/index');
        } else {
            Session::put('message', 'Incorrect acccount or password');
            return Redirect::to('/login');
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
