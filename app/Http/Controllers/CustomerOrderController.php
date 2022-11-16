<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function order_product(Request $request) {
        $content = Cart::content();
        $new_order = array();
        $new_order['CustomerID'] = $request->customerid;
        $new_order['TotalPrice'] = Cart::total();
        $new_order['OrderStatusID'] = 1;
        $check_order = DB::table('order')->insert($new_order);
        return response()->json(true,200);
    }
}
