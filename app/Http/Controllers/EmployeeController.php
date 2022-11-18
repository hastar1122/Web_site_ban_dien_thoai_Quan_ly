<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function add_employee(Request $request)
    {
        $file = $request->file('imageemployee');
        // $fileName = time() . '.' . $file->getClientOriginalExtension();
        // $file->move(public_path('admin/img'), $fileName);
        $fileName = null;
        if ($file) {
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/img'),$fileName);
        }
        
        $empData = [
            'UserAccount' => $request->employee_account,
            'Password' => bcrypt(1),
            'UserName' => $request->employee_name,
            'PhoneNumber' => $request->employee_phone,
            'Address' => $request->employee_address,
            'Email' => $request->employee_email,
            'Image' => $fileName,
            'RoleID' => 2
        ];

        $check = DB::table('user')->insert($empData);
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function all_employee()
    {
        $all_employee_get = DB::table('user')
            ->select('user.UserID', 'UserAccount', 'Image', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber')
            ->where('user.RoleID', '=', 2)
            ->paginate(5);
        if ($key = request()->employee_search) {
            $all_employee_get = DB::table('user')
                ->select('user.UserID', 'UserAccount', 'Image', 'user.UserName', 'user.Address', 'user.Email', 'user.PhoneNumber')
                ->where('user.RoleID', '=', 2)
                ->where('user.UserAccount', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view('admin.pages.all_employee', compact('all_employee_get'));
    }
    public function delete_employee($employee_id)
    {
        $check = DB::table('user')->where('UserID', $employee_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }

    public function edit_employee($employee_id)
    {
        $employee_get_id = DB::select(DB::raw(" select UserID,UserAccount,Image,UserName,Address,Email,PhoneNumber from user where UserID=$employee_id"));
        return response()->json(['employee_get' => $employee_get_id], 200);
    }
    public function update_employee(Request $request, $employee_id)
    {
        $fileName = '';
        $employee = DB::table('user')->where('UserID', $request->UserID)->get();
        foreach ($employee as $nhanvien) {
            $ImageOld = $nhanvien->Image;
        }
        if ($request->hasFile('imageeditne')) {
            $file = $request->file('imageeditne');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('admin/img'), $fileName);
            if ($ImageOld) {
                Storage::delete('admin/img/' . $ImageOld);
            }
        } else {
            $fileName = $request->emp_img;
        }
        $empData = [
            'UserName' => $request->employee_name,
            'Address' => $request->employee_address,
            'Email' => $request->employee_email,
            'PhoneNumber' => $request->employee_phone,
            'Image' => $fileName
        ];
       $employeeNew= DB::table('user')->where('UserID', $request->UserID)->update($empData);
        // $employee->update($empData);
        if ($employeeNew) {
            return response()->json(null, 200);
        } else
            return response()->json(null, 400);
    }
}
