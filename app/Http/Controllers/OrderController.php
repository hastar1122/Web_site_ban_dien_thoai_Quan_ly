<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\UserNamee;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function view_order($orderid){

        $order_detail =   Orderdetail::where('OrderID',$orderid)->get();
        $order =    Order::where('OrderID',$orderid)->get();

        foreach($order as $key => $ord){
            $customerID = $ord->CustomerID;
            $employeeID = $ord->EmployeeID;
            $orderstatusID = $ord->OrderStatusID;
        }

        $customer = UserNamee::where('UserID',$customerID)->first();
        $employee = UserNamee::where('UserID',$employeeID)->first();
        $status =   Status::orderby('OrderStatusID','DESC')->get();
        $status2 =   Status::where('OrderStatusID',$orderstatusID)->first();
        // $order_detail =   Orderdetail::where('OrderCode',$ordercode)->get();

        foreach($order_detail as $key => $ord_detail){
            $productID = $ord_detail->ProductID;

        }
        $product = Product::where('ProductID',$productID)->first();
        // $order_detail = Orderdetail::with('product')->where('OrderCode',$ordercode)->get();

        return view('admin.pages.view_order')->with(compact('order_detail','customer','employee','product','order','status','status2'));
    }

    public function manager_order(){
        
        $order =    Order::orderby('OrderDate','DESC')->get();
        foreach($order as $key => $ord){
            $orderstatusID = $ord->OrderStatusID;
        }
        $status =   Status::where('OrderStatusID',$orderstatusID)->first();
       
        return view('admin.pages.manager_order')->with(compact('order','status'));
    }

    public function updatestatus(Request $request,$orderid){
        // $order = Order::find($orderid);
        // $info = array();
        // $info['OrderStatusID'] = $request->status;
        // $order->update($info);
        // return redirect('/manager-oder');
        $order = DB::table('order')
                ->where('OrderID', $orderid)
                ->update([
                    'OrderStatusID' => $request->status,
                ]);
       return redirect('/manager-order');
    }
}
