<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = Cart::content();
        $new_order = array();
        $new_order['OrderCode'] = 'DH-'.trim(str_replace(" ", "_", Carbon::now()));
        $new_order['CustomerID'] = $request->customer_id;
        $new_order['TotalPrice'] = Cart::total(0,'','');
        $new_order['OrderStatusID'] = 1;
        $new_order['OrderDate'] = Carbon::now();
        $new_order['Address'] = $request->orderaddress;
        $check_order = DB::table('order')->insertGetId($new_order);

        foreach($content as $pro) {
            $new_product = array();
            $new_product['OrderID'] = $check_order;
            $new_product['ProductID'] = $pro->id;
            $new_product['Price'] = $pro->price;
            $new_product['Amount'] = $pro->qty;
            $new_product['TotalPrice'] = $pro->qty * $pro->price;
            $insertproduct = DB::table('orderdetail')->insert($new_product);
        }
        Cart::destroy();
        return redirect('show-cart')->with('message','Đặt hàng thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
