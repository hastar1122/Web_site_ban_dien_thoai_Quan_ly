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
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $all_product = DB::table('product')->get();
        $id = $request['product_id'];
        $product = DB::table('product')->where('ProductID', 1)->first();
        $data['id'] = $id;
        $data['name'] = $product->ProductName;
        $data['qty'] = 1;
        $data['price'] = $product->Price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->Image;
        $check = Cart::add($data);
        return view('client.pages.checkout')->with('category',$cate_product);
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
