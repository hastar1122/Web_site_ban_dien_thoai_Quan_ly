<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function add_supplier(Request $request)
    {
        $data = array();
        $data['UserName'] = $request->suppliername;
        $data['Address'] = $request->address;
        $data['Email'] = $request->email;
        $data['PhoneNumber'] = $request->phonenumber;
        $data['RoleID'] = 3;
        $check = DB::table('user')->insert($data);
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function all_supplier()
    {
        $all_supplier_get = DB::table('user')
            ->select('user.UserID', 'user.UserName','user.Address', 'user.Email', 'user.PhoneNumber')
            ->where('user.RoleID', '=', 3)
            ->paginate(5);
        if ($key = request()->supplier_search) {
            $all_supplier_get = DB::table('user')
                ->select('user.UserID', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber')
                ->where('user.RoleID', '=', 3)
                ->where('user.UserName', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view('admin.pages.all_supplier', compact('all_supplier_get'));
    }
    public function delete_supplier($supplier_id)
    {
        $check = DB::table('user')->where('UserID', $supplier_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }

    public function edit_supplier($supplier_id)
    {
        $supplier_get_id = DB::select(DB::raw(" select UserID,UserName,Address,Email,PhoneNumber from user where UserID=$supplier_id"));
        
        return response()->json([ 'supplier_get' => $supplier_get_id], 200);
    }
    public function update_supplier(Request $request, $supplier_id)
    {
        $supplier = DB::table('user')
            ->where('UserID', $supplier_id)
            ->update([
                'UserName' => $request->username,
                'Address' => $request->address,
                'Email' => $request->email,
                'PhoneNumber' => $request->phonenumber,
            ]);
        if ($supplier) {
            return response()->json(null, 204); 
        } else
            return response()->json(null, 400);
    }
}
