<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{

    public function show_cart() {
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $all_product = DB::table('product')->get();
        return view('client.pages.checkout')->with('category',$cate_product);
    }

    public function save_cart(Request $request) {

    }


    public function delete_cart($rowId) {
        Cart::update($rowId, 0);
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        return view('client.pages.checkout')->with('category',$cate_product);
    }

    public function delete_all_cart() {
        Cart::destroy();
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        return redirect()->back();
    }

}
