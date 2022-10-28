<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login() {
        $acc = DB::select('select * from user');
        dd($acc);
        //return view('pages.login');
    }
}
