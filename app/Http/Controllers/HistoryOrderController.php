<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HistoryOrderController extends Controller
{
    public function show_history($id) {
        $check = DB::table('order')->where('CustomerID', $id)->orderBy('OrderStatusID','ASC')->get();
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
        //dd($getOrderDetail);
        return view('client.pages.list-order-product')->with(compact('category', 'getOrderDetail', 'getOrder'));
    }

    public function delete_order($id, Request $request) {
        $delOrderDetail = DB::table('orderdetail')->where('OrderID', $id)->delete();
        $delOrder = DB::table('order')->where('OrderID', $id)->where('OrderStatusID', 1)->delete();
        $check = DB::table('order')->where('CustomerID', $request->customerid)->get();
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();

        if ($delOrder) {
            $message = 1;
        } else {
            $message = 0;
        }
        return view('client.pages.table-cart-history')->with('content', $check)->with('category',$cate_product)->with('message', $message);
    }
}
