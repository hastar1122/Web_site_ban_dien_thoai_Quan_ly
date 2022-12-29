<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ImportBillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $importBills = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID',)->orderby('ImportDate','DESC')->get();
        return view('admin.importBill.index', compact('importBills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy ra danh sách sản phẩm
        $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->orderByDesc('CreatedDate')
            ->get();
        // Lấy ra danh sách phân loại sản phẩm
        $categorys = DB::table('category')->get();
        // Lấy ra danh sách thương hiệu
        $brands = DB::table('brand')->get();
        // Lấy ra danh sách các nhà cung cấp
        $suppliers = DB::table('user')->where('user.RoleID', '=', 3)->get();
        return view('admin.importBill.create', compact('suppliers','products','categorys','brands'));
    }

    /**
     * Hàm load danh sách phiếu nhập
     */
    public function loadImportBills (Request $request) {
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        $importBills = null;
        if ($from_date && $to_date) {
            $importBills = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID',)->where('ImportDate', '>=', $from_date)->where('ImportDate', '<=', $to_date)->orderby('ImportDate','DESC')->get();
        }
        else if ($from_date) {
            $importBills = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID',)->where('ImportDate', '>=', $from_date)->orderby('ImportDate','DESC')->get();
        }
        else if ($to_date) {
            $importBills = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID',)->where('ImportDate', '<=', $to_date)->orderby('ImportDate','DESC')->get();
        }
        else {
            $importBills = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID',)->orderby('ImportDate','DESC')->get();
        }
        return view('admin.importBill.list_import', compact('importBills'));
    }

    /**
     * Hàm load danh sách sản phẩm
     */
    public function loadProducts(Request $request) {
        $categoryID = $request['category'];
        $brandID = $request['brand'];
        $products = null;
        // Lấy ra danh sách sản phẩm
        if ($categoryID && $brandID) {
            $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->where('category.CategoryID', '=', $categoryID)
            ->where('brand.BrandID', '=', $brandID)
            ->orderByDesc('CreatedDate')
            ->get();
        }
        elseif ($categoryID) {
            $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->where('category.CategoryID', '=', $categoryID)
            ->orderByDesc('CreatedDate')
            ->get();
        }
        elseif ($brandID) {
            $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->where('brand.BrandID', '=', $brandID)
            ->orderByDesc('CreatedDate')
            ->get();
        }
        else {
            $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->orderByDesc('CreatedDate')
            ->get();
        }
        return view('admin.importBill.listProduct')->with('products', $products);
    }

    /**
     * Hàm thêm sản phẩm vào bảng danh sách các sản phẩm nhập kho
     */
    public function addProduct($id) {
        // Lấy ra thông tin sản phẩm
        $product = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->where('ProductID', $id)
            ->first();
        return view('admin.importBill.addProduct', compact('product'));
    }

    /**
     * Hàm lấy thông tin nhà cung cấp
     */
    public function infoSupplier(Request $request)
    {
        $SupplierID = $request['SupplierID'];
        if ($SupplierID)
        {
            $Supplier = DB::table('user')->where('user.UserID', '=', $SupplierID)->get()->first();
            return response()->json($Supplier  ,200);
        }
        else 
            return response()->json(false  ,200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Biến lưu lại tổng tiền của phiếu nhập
        $TotalPrice = 0; 

        // Lưu thông tin phiếu nhập và lấy ra id của phiếu nhập vừa nhập để thêm vào bảng chi tiết
        $importBillID = DB::table('importbill')->insertGetId(
            [
                'ImportBillCode' => 'DH-'.trim(str_replace(" ", "_", Carbon::now())),
                'SupplierID' => $request->input('SupplierID'),
                'EmployeeID' => Auth::user()->UserID,
                'ImportDate' => Carbon::now()
            ]
        );

        // Duyệt danh sách sản phẩm được nhập hàng
        for ($i=0; $i < count($request->input('ProductID')); $i++) { 
            // Lưu thông tin chi tiết phiếu nhập
            $importBillDetailID = DB::table('importbilldetail')->insertGetId([
                'ImportBillID' => $importBillID,
                'ProductID' => $request->input('ProductID')[$i],
                'Price' => $request->input('OutwardPrice')[$i],
                'Amount' => $request->input('Amount')[$i],
                'TotalPrice' => $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i]
            ]);

            // Cộng tổng tiền của từng sản phẩm được nhập
            $TotalPrice += $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i];
            
            // Lấy ra danh sách emei của từng sản phẩm
            $emies = explode (';', $request->input('Emei')[$i]);

            // Lưu thông tin vào bảng chi tiết sản phẩm với từng emei của sản phẩm
            for ($y=0; $y < count($emies); $y++) { 
                DB::table('productitem')->insert([
                    'ProductID' => $request->input('ProductID')[$i],
                    'ImportBillDetailID' => $importBillDetailID,
                    'SKU' => $emies[$y],
                    'Status' => 0,
                ]);
            }
        }

        // Cập nhật lại tổng tiền của phiếu nhập
        DB::table('importbill')->where('ImportBillID', $importBillID)->update([
            'TotalPrice' => $TotalPrice
        ]);

        return Redirect::to('importBill');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Lấy ra danh sách sản phẩm
        $products = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->orderByDesc('CreatedDate')
            ->get();
        // Lấy ra danh sách phân loại sản phẩm
        $categorys = DB::table('category')->get();
        // Lấy ra danh sách thương hiệu
        $brands = DB::table('brand')->get();
        // Lấy ra danh sách các nhà cung cấp
        $suppliers = DB::table('user')->where('user.RoleID', '=', 3)->get();

        // Lấy ra thông tin phiếu nhập
        $importBill = DB::table('importbill')->join('user', 'user.UserID', '=', 'importbill.SupplierID')->where('ImportBillID', $id)->first();

        // Lấy ra thông tin chi tiết phiếu nhập
        $importBillDetails = DB::table('importbilldetail')->join('product', 'product.ProductID', '=', 'importbilldetail.ProductID')->where('ImportBillID', $id)->select('importbilldetail.*', 'product.ProductCode', 'product.ProductName', 'product.Image')->get();

        // Duyệt từng sản phẩm trong chi tiết phiếu nhập để lấy ra danh sách các sản phẩm với từng Emei
        for ($i=0; $i < count($importBillDetails); $i++) { 
            $importBillDetails[$i]->productItems = DB::table('productitem')->where('ImportBillDetailID', $importBillDetails[$i]->ImportBillDetailID)->get();
        }

        return view('admin.importBill.edit', compact('suppliers','products','categorys','brands','importBillDetails','importBill'));
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
        // Biến lưu lại tổng tiền của phiếu nhập
        $TotalPrice = 0; 

        // Duyệt danh sách sản phẩm được nhập hàng
        for ($i=0; $i < count($request->input('ProductID')); $i++) { 
            // Lẩy ra khóa chính của chi tiết phiếu nhập theo ID phiếu nhập và ID sản phẩm
            $importBillDetail  = DB::table('importbilldetail')->where('ImportBillID', $id)->where('ProductID', $request->input('ProductID')[$i])->first();
            
            // Nếu sản phẩm này đã được nhập trước đó
            if ($importBillDetail) {
                // Cập nhật chi tiết phiếu nhập
                DB::table('importbilldetail')->where('ImportBillDetailID', $importBillDetail->ImportBillDetailID)->update([
                    'Price' => $request->input('OutwardPrice')[$i],
                    'Amount' => $request->input('Amount')[$i],
                    'TotalPrice' => $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i]
                ]);
               
                // Cộng tổng tiền của từng sản phẩm được nhập
                $TotalPrice += $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i];
                
                if ($request->input('Emei')[$i]) {
                    // Lấy ra danh sách emei của từng sản phẩm nếu có
                    $emies = explode (';', $request->input('Emei')[$i]);

                    // Lưu thông tin vào bảng chi tiết sản phẩm với từng emei của sản phẩm
                    for ($y=0; $y < count($emies); $y++) { 
                        DB::table('productitem')->insert([
                            'ProductID' => $request->input('ProductID')[$i],
                            'ImportBillDetailID' => $importBillDetail->ImportBillDetailID,
                            'SKU' => $emies[$y],
                            'Status' => 0,
                        ]);
                    }
                }
            }
            // Nếu không có thì thêm mới
            else {
                // Lưu thông tin chi tiết phiếu nhập
                $importBillDetailID = DB::table('importbilldetail')->insertGetId([
                    'ImportBillID' => $id,
                    'ProductID' => $request->input('ProductID')[$i],
                    'Price' => $request->input('OutwardPrice')[$i],
                    'Amount' => $request->input('Amount')[$i],
                    'TotalPrice' => $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i]
                ]);

                // Cộng tổng tiền của từng sản phẩm được nhập
                $TotalPrice += $request->input('OutwardPrice')[$i] * $request->input('Amount')[$i];
                
                // Lấy ra danh sách emei của từng sản phẩm
                $emies = explode (';', $request->input('Emei')[$i]);

                // Lưu thông tin vào bảng chi tiết sản phẩm với từng emei của sản phẩm
                for ($y=0; $y < count($emies); $y++) { 
                    DB::table('productitem')->insert([
                        'ProductID' => $request->input('ProductID')[$i],
                        'ImportBillDetailID' => $importBillDetailID,
                        'SKU' => $emies[$y],
                        'Status' => 0,
                    ]);
                }
            }
        }

        // Xóa các importbilldetail bị xóa trên client
        if ($request->input('ImportBillDetailDeleted')) {
            for ($i=0; $i < count($request->input('ImportBillDetailDeleted')); $i++) { 
                // Xóa các productitem trước
                DB::table('productitem')->where('ImportBillDetailID', $request->input('ImportBillDetailDeleted')[$i])->delete();
                // Xóa chi tiết phiếu nhập
                DB::table('importbilldetail')->where('ImportBillDetailID', $request->input('ImportBillDetailDeleted')[$i])->delete();
            }
        }

        // Xóa các productitem bị xóa trên client
        if ($request->input('ProductItemDeleted')) {
            for ($i=0; $i < count($request->input('ProductItemDeleted')); $i++) { 
                DB::table('productitem')->where('ProductItemID', $request->input('ProductItemDeleted')[$i])->delete();
            }
        }

        // Cập nhật lại thông tin phiếu nhập
        DB::table('importbill')->where('ImportBillID', $id)->update(
            [
                'SupplierID' => $request->input('SupplierID'),
                'EmployeeID' => Auth::user()->UserID,
                'TotalPrice' => $TotalPrice,
            ]
        );

        return Redirect::to('importBill');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Lấy ra danh sách chi tiết phiếu nhập
        $importBillDetails = DB::table('importbilldetail')->where('ImportBillID', $id)->get();
        // Duyệt từng sản phẩm trong chi tiết để kiểm tra
        foreach ($importBillDetails as $importBillDetail) {
            // Lấy ra danh sách  các productitem theo từng sản phẩm trong chi tiết phiếu nhập
            $productItems = DB::table('productitem')->where('ImportBillDetailID', $importBillDetail->ImportBillDetailID)->get();
            // Nếu có sản phẩm dã được bán thì không xóa phiếu nhập
            foreach ($productItems as $productItem) {
                if ($productItem->Status == true) {
                    return response()->json(false, 200);
                }
            }
        }

        // Nếu không thì xóa từng bảng detail
        DB::table('productitem')->where('ImportBillDetailID', $importBillDetail->ImportBillDetailID)->delete();
        DB::table('importbilldetail')->where('ImportBillID', $id)->delete();
        DB::table('importbill')->where('ImportBillID', $id)->delete();

        return response()->json(true, 200);
    }
}
