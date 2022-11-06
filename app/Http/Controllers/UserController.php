<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function add_user()
    {
        return view('pages.all_user');
    }
    public function all_user()
    {
        $all_user_get = DB::table('user')
            ->join('role', 'user.RoleID', '=', 'role.RoleID')
            ->select('user.UserID', 'user.UserAccount', 'user.Password', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber', 'role.RoleName')
            ->paginate(6);
        if ($key = request()->user_search) {
            $all_user_get = DB::table('user')
                ->join('role', 'user.RoleID', '=', 'role.RoleID')
                ->select('user.UserID', 'user.UserAccount', 'user.Password', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber', 'role.RoleName')
                ->where('user.UserAccount', 'like', '%' . $key . '%')
                ->paginate(6);
        }
        if ($key2 = request()->rolename) {
            $all_user_get = DB::table('user')
                ->join('role', 'user.RoleID', '=', 'role.RoleID')
                ->select('user.UserID', 'user.UserAccount', 'user.Password', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber', 'role.RoleName')
                ->where('role.RoleName', '=', $key2)
                ->paginate(6);
        }
        $all_role_get = DB::table('role')
            ->select('role.RoleID', 'role.RoleName')
            ->get();
        return view('pages.all_user', compact('all_user_get', 'all_role_get'));
    }
    public function delete_user($user_id)
    {
        $check = DB::table('user')->where('UserID', $user_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function edit_user($user_id)
    {
        $user_get_id = DB::select(DB::raw(" select UserID,UserAccount,UserName,Address,Email,PhoneNumber,Image,RoleID from user where UserID=$user_id"));
        $role = DB::select(DB::raw("SELECT RoleID,RoleName
        FROM role
        "));
        return response()->json(['role' => $role, 'user_get' => $user_get_id], 200);
    }
}
