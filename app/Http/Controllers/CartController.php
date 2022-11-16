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

    /**
     * Hàm trả lại view giỏ hàng
     */
    public function view_cart()
    {
        return view('client.pages.cart');
    }

    /**
     * Hàm mua sản phẩm ở trang chi tiết sản phẩm
     */
    public function buy_product(Request $request)
    {
        $product = DB::table('product')->where('ProductID', $request->input('ProductID'))->first();
        //thêm dữ liệu vào Cart
        $data['id'] = $request->input('ProductID');
        $data['name'] = $product->ProductName;
        $data['qty'] = $request->input('Quality');
        $data['price'] = $product->Price;
        $data['weight'] = 1;
        $data['options']['image'] = $product->Image;
        $check = Cart::add($data);
        return response()->json(true,200);
    }
}
