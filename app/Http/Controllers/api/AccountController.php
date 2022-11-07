<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdateAccountRequest;
use Illuminate\Support\Facades\Auth;
session_start();

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return "ok";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('index')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAccountRequest $request, $id)
    {

        $user=User::find($id);
        # move image to public/img
        $info = array();
        $info['UserName'] = $request->name;
        $info['Address'] = $request->address;
        $info['Email'] = $request->email;
        $info['PhoneNumber'] = $request->phone;

        if ($request->image != $request->fakeimage){
            $profile_image = 'image'.time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->image->move(public_path('admin/img'),$profile_image);
            $info['Image'] = $profile_image;
        }

        $user->update($info);
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
