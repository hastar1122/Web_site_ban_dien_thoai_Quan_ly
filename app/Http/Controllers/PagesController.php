<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class PagesController extends Controller
{
    public function index()
    {   
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $new_product = DB::table('product')->orderby('CreatedDate', 'desc')->limit(3)->get();
        $expen_product = DB::table('product')->orderby('Price', 'desc')->limit(3)->get();
        $iphone_product = DB::table('product')->where('ProductName', 'like', '%Iphone%')->limit(3)->get();
        $best_sell = DB::table('product')
            ->join('orderdetail', 'product.ProductID', '=', 'orderdetail.ProductID')
            ->select('product.Price','product.ProductName','product.Image','product.ProductID')
            ->orderby('orderdetail.amount', 'desc')->limit(4)->get();
        return view('client.index')->with('category',$cate_product)->with('newproduct', $new_product)->with('expenproduct', $expen_product)->with('iphoneproduct', $iphone_product)->with('bestsell', $best_sell);
    }
    public function loadAllProduct()
    {
        $cate_product = DB::table('category')->orderBy('CategoryID','DESC')->get();
        $all_product = DB::table('product')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.product')->with('allproduct', $all_product)->with('allbrand',$all_brand)->with('category',$cate_product);
    }

    /**
     * Hàm load chi tiết sản phẩm
     */
    public function productdetail($id)
    {
        // Lấy ra thông tin chung của sản phẩm
        $product = DB::table('product')->where('product.ProductID', '=', $id)->first();
        // Lấy ra danh sách các thuộc tính theo từng loại sản phẩm
        $attributes = DB::table('attribute')
            ->join('categoryattribute', 'categoryattribute.AttributeID', '=', 'attribute.AttributeID')
            ->join('category', 'category.CategoryID', '=', 'categoryattribute.CategoryID')
            ->where('category.CategoryID', '=', $product->CategoryID)
            ->select('AttributeName', 'attribute.AttributeID')
            ->get();
        // Lấy ra danh sách giá trị theo từng thuộc tính
        $attributevalues = DB::table('product')
            ->join('productattribute','productattribute.ProductID', '=', 'product.ProductID')
            ->join('attribute','attribute.AttributeID', '=', 'productattribute.AttributeID')
            ->where('product.ProductID', '=', $product->ProductID)
            ->get();
        $category = DB::table('category')->orderBy('CategoryID','DESC')->get();
        return view('client.pages.productdetail', compact('category', 'product','attributes','attributevalues'));
    }
}
