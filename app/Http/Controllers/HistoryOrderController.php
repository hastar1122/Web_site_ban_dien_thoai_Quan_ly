<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HistoryOrderController extends Controller
{
    public function show_history($id) {
        $check = DB::table('order')->where('CustomerID', $id)->get();
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        return view('client.pages.table-cart-history')->with('content', $check)->with('category',$cate_product);
    }

    public function show_history_detail($id) {
        $category = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $getOrder = DB::table('order')->where('OrderID', $id)->first();
        $getOrderDetail = DB::table('orderdetail as a')
            ->leftJoin('product as b', 'a.ProductID', '=', 'b.ProductID')
            ->where('OrderID', $id)
            ->get();
        return view('client.pages.list-order-product')->with(compact('category', 'getOrderDetail', 'getOrder'));
    }
}
