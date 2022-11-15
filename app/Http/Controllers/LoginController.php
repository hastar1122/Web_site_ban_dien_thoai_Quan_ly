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
        if(Auth::check()){
            $brand = DB::table('brand')->get()->count();
            $category = DB::table('category')->get()->count();
            $employee = DB::table('user')->join('role', 'user.RoleID', '=', 'role.RoleID')->where('role.RoleID', '=', 2)->get()->count();
            $supplier = DB::table('user')->join('role', 'user.RoleID', '=', 'role.RoleID')->where('role.RoleID', '=', 3)->get()->count();
            $customer = DB::table('user')->join('role', 'user.RoleID', '=', 'role.RoleID')->where('role.RoleID', '=', 4)->get()->count();
            $attribute = DB::table('attribute')->get()->count();
            $product = DB::table('product')->get()->count();
            $order = DB::table('order')->get()->count();
            return view('admin.index', compact('brand', 'category', 'employee', 'supplier', 'customer', 'attribute', 'product', 'order'));
        }
        else
            return view('admin.pages.login');
    }

    public function postLogin(Request $request) {
        $admin = [
            'UserAccount' => $request['account'],
            'password' => $request['password'],
            'RoleID' => 1,
        ];

        $employee = [
            'UserAccount' => $request['account'],
            'password' => $request['password'],
            'RoleID' => 2,
        ];

        $customer = [
            'UserAccount' => $request['username'],
            'password' => $request['password1'],
            'RoleID' => 4,
        ];
        if (Auth::attempt($admin) || Auth::attempt($employee)) {
            return Redirect::to('index');
        } else if (Auth::attempt($customer)){
            return Redirect::to('showClient');
        } else if (!$request['account']) {
            dd($customer);
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
