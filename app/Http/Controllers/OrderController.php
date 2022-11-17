<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;
use App\Models\UserNamee;
use App\Models\Product;
use App\Models\Status;
use Illuminate\Support\Facades\Auth;
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
        // Lấy ra thông tin dơn hàng
        $order = DB::table('order')->join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')->where('OrderID', '=', $orderid)->first();
        // Lẩy ra thông tin chi tiết đơn hàng
        $orderDetail = DB::table('orderdetail')->where('OrderID', '=', (int)$orderid)->get();

        // Nếu đơn hàng đang được xử lý hoặc là đã bị hủy
        if($order->OrderStatusID == 1 || $order->OrderStatusID == 4) {
            // Nếu cập nhật trạng thái là hủy đơn hàng hoặc đang xử lý
            if ($request->input('OrderStatusID') == 1 || $request->input('OrderStatusID') == 4) {
                DB::table('order')->where('OrderID', '=', $orderid)->update([
                    'OrderStatusID' => $request->input('OrderStatusID'),
                    'EmployeeID' => Auth::user()->UserID
                ]);
            }
            // Nếu cập nhật trạng thái là đang giao hàng hoặc là giao hàng thành công
            elseif ($request->input('OrderStatusID') == 2 || $request->input('OrderStatusID') == 3) {
                // Kiểm tra số lượng tồn kho của từng sản phẩm
                foreach ($orderDetail as $item) {
                    $product = DB::table('product')->where('ProductID', '=', $item->ProductID)->first();
                    if ($item->Amount > $product->Amount) {
                        return response()->json($product ,200);
                    }
                }
                
                // Nếu các sản phẩm trong đơn hàng còn hàng thì update lại số lượng tồn kho
                foreach ($orderDetail as $item) {
                    $product = DB::table('product')->where('ProductID', '=', $item->ProductID)->first();
                    DB::table('product')->where('ProductID', $product->ProductID)->update([
                        'Amount' => $product->Amount - $item->Amount
                    ]);
                }

                // Cập nhật lại trạng thái đơn hàng
                DB::table('order')->where('OrderID', $orderid)->update([
                    'OrderStatusID' => $request->input('OrderStatusID'),
                    'EmployeeID' => Auth::user()->UserID
                ]);
            }
        }
        else {
            // Nếu cập nhật trạng thái đang giao hàng hoặc giao hàng thành công
            if ($request->input('OrderStatusID') == 2 || $request->input('OrderStatusID') == 3) {
                DB::table('order')->where('OrderID', '=', $orderid)->update([
                    'OrderStatusID' => $request->input('OrderStatusID'),
                    'EmployeeID' => Auth::user()->UserID
                ]);
            }
            // Nếu cập nhật trạng thái là hủy đơn hàng hoặc đang xử lý
            elseif ($request->input('OrderStatusID') == 1 || $request->input('OrderStatusID') == 4) {
                // Cập nhật lại số lượng tồn kho của từng sản phẩm
                foreach ($orderDetail as $item) {
                    $product = DB::table('product')->where('ProductID', '=', $item->ProductID)->first();
                    DB::table('product')->where('ProductID', '=', $product->ProductID)->update([
                        'Amount' => $product->Amount + $item->Amount
                    ]);
                }

                // Cập nhật lại trạng thái đơn hàng
                DB::table('order')->where('OrderID', $orderid)->update([
                    'OrderStatusID' => $request->input('OrderStatusID'),
                    'EmployeeID' => Auth::user()->UserID
                ]);
            }
        }
        return response()->json(true  ,200);
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

    public function info_order ($orderid)
    {
        // Lấy ra thông tin hóa đơn
        $order = DB::table('order')->join('orderstatus', 'orderstatus.OrderStatusID', '=', 'order.OrderStatusID')->where('OrderID', $orderid)->first();
        // Lấy ra thông tin nhân viên
        $employee = DB::table('User')->where('UserID', $order->EmployeeID)->first();

        return view('admin.orders.info_order', compact('order','employee'));
    }
}
