<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function index() {
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        
        return view('client.index')->with('category',$cate_product);
    }
}
