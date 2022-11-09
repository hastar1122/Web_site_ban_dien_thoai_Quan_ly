<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index() {
        if (Auth::check() && Auth::user()->RoleID==4) {
            return view('client.layouts.app');
        }
        else {
            return view('client.layouts.main-app');
        }
    }

    public function indexLogged() {
        if (Auth::check() && Auth::user()->RoleID==4) {
            return view('client.layouts.app');
        }
        else {
            return view('client.layouts.main-app');
        }
    }
}
