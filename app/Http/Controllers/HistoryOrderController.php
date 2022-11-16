<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoryOrderController extends Controller
{
    public function show_history($id) {
        $check = DB::table('order')->where('CustomerID', $id)->get();
        return view('client.pages.cart-history')->with('content', $check);
    }
}
