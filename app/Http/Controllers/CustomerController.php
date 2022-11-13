<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
  
    public function all_customer()
    {
        $all_customer_get = DB::table('user')
            ->select('user.UserID', 'UserAccount', 'Image', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber')
            ->where('user.RoleID', '=', 4)
            ->paginate(5);
        if ($key = request()->customer_search) {
            $all_customer_get = DB::table('user')
                ->select('user.UserID', 'UserAccount', 'Image', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber')
                ->where('user.RoleID', '=', 4)
                ->where('user.UserAccount', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view('admin.pages.all_customer', compact('all_customer_get'));
    }
    public function delete_customer($customer_id)
    {
        $check = DB::table('user')->where('UserID', $customer_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }

}
