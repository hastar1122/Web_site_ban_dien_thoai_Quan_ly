<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{

    public function show() {
        return view('pages.change-password');
    }

    public function changePassword(ChangePasswordRequest $request) {
        $oldpassword = $request->oldpassword;
        $userID = Session::get('admin_id');
        $new_pass = array();
        $new_pass['Password'] = $request->newpassword;
        $result = DB::table('user')->where('UserID', $userID)->where('Password',$oldpassword)->update($new_pass);
        if ($result) {
            return Redirect::back()->with('success', 'Changed password successfull');
        } else {
            return Redirect::back()->with('fail', 'Incorrect current password');
        }

    }
}
