<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Models\User;


class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegisterRequest $request)
    {
        //dd($request);
        $account = $request['account'];
        $request->flash();
        $result = DB::table('user')->where('UserAccount', $account)->first();
        if ($request['role'] == 1) {
            if ($result) {
                Session::put('message', 'Tài khoản đã tồn tại');
                return Redirect::to('/register');
            } else {
                $new_user = array();
                $new_user['UserAccount'] = $request->account;
                $new_user['Password'] =bcrypt($request->password);
                $new_user['UserName'] = $request->name;
                $new_user['Image'] = 'avt.png';
                $new_user['RoleID'] = $request->role;

                User::create($new_user);
                return redirect('/login')->with('status', 'Đăng ký thành công');
            }
        }
        if ($request['role'] == 4){
            if ($result) {
                return response()->json(null, 400);
            } else {
                $new_user = array();
                $new_user['UserAccount'] = $request['account'];
                $new_user['Password'] =bcrypt($request['password']);
                $new_user['UserName'] = $request['name'];
                $new_user['Image'] = 'avt.png';
                $new_user['RoleID'] = $request['role'];

                User::create($new_user);
                return response()->json(null, 200);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
