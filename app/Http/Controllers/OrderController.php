<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\UserNamee;
use App\Models\Product;
class OrderController extends Controller
{
    public function view_order($orderid){
        $order_detail =   Orderdetail::where('OrderID',$orderid)->get();
        $order =    Order::where('OrderID',$orderid)->get();

        foreach($order as $key => $ord){
            $customerID = $ord->CustomerID;
            $employeeID = $ord->EmployeeID;
        }

        $customer = UserNamee::where('UserID',$customerID)->first();
        $employee = UserNamee::where('UserID',$employeeID)->first();

        // $order_detail =   Orderdetail::where('OrderCode',$ordercode)->get();
        foreach($order_detail as $key => $ord_detail){
            $productID = $ord_detail->ProductID;

        }
        $product = Product::where('ProductID',$productID)->first();
        // $order_detail = Orderdetail::with('product')->where('OrderCode',$ordercode)->get();

        return view('pages.view_order')->with(compact('order_detail','customer','employee','product'));
    }

    public function manager_order(){
        $order =    Order::orderby('OrderDate','DESC')->get();
        return view('pages.manager_order')->with(compact('order'));
    }
}
