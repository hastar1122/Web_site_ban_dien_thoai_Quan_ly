<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function index()
    {   
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $new_product = DB::table('product')->orderby('ProductID', 'desc')->limit(3)->get();
        $expen_product = DB::table('product')->orderby('Price', 'desc')->limit(3)->get();
        $iphone_product = DB::table('product')->where('ProductName', 'like', '%Iphone%')->limit(3)->get();
        $best_sell = DB::table('product')
            ->join('orderdetail', 'product.ProductID', '=', 'orderdetail.ProductID')
            ->select('product.Price','product.ProductName','product.Image')
            ->orderby('orderdetail.amount', 'desc')->limit(4)->get();
        return view('client.index')->with('category',$cate_product)->with('newproduct', $new_product)->with('expenproduct', $expen_product)->with('iphoneproduct', $iphone_product)->with('bestsell', $best_sell);
    }
    public function loadAllProduct()
    {
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $all_product = DB::table('product')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.product')->with('allproduct', $all_product)->with('allbrand',$all_brand)->with('category',$cate_product);
    }
}
