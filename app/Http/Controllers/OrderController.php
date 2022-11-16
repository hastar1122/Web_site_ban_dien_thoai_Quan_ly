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
        // Lấy ra thông tin hóa đơn
        $order = DB::table('order')->join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')->where('OrderID', $orderid)->first();
        // Lấy ra thông tin khách hàng
        $customer = DB::table('User')->where('UserID', $order->CustomerID)->first();
        // Lấy ra thông tin nhân viên
        $employee = DB::table('User')->where('UserID', $order->EmployeeID)->first();
        // Lẩy ra danh sách sản phẩm trong hóa đơn
        $products = DB::table('product')
            ->join('orderdetail', 'product.ProductID', '=', 'orderdetail.ProductID')
            ->where('orderdetail.OrderID', $orderid)
            ->select('orderdetail.Price','product.ProductName','product.Image','product.ProductID','orderdetail.TotalPrice','orderdetail.Amount', 'product.ProductCode')->get();
        // Lẩy ra danh sách trạng thái hóa đơn
        $orderStatus = DB::table('orderstatus')->get();

        return view('admin.orders.view_order', compact('order','customer','employee','products','orderStatus'));
    }

    public function manager_order(){

        $orders = Order::join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')
        ->join('user', 'user.UserID','=','order.CustomerID')
        ->orderby('OrderDate','DESC')->get();
        $orderStatus = Status::all();

        return view('admin.orders.manager_order')->with(compact('orders','orderStatus'));
    }

    public function updatestatus(Request $request, $orderid){
        $order = DB::table('order')
                ->where('OrderID', $orderid)
                ->update([
                    'OrderStatusID' => $request->status,
                ]);
       return redirect('/manager-order');
    }

    public function list_order(Request $request)
    {
        if ($request->input('OrderStatusID')) {
            $orders = Order::join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')
            ->where('order.OrderStatusID', $request->input('OrderStatusID'))
            ->join('user', 'user.UserID','=','order.CustomerID')
            ->orderby('OrderDate','DESC')
            ->get();
        }
        else {
            $orders = Order::join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')
            ->join('user', 'user.UserID','=','order.CustomerID')
            ->orderby('OrderDate','DESC')
            ->get();
        }

        return view('admin.orders.list_order')->with(compact('orders'));
    }
}
