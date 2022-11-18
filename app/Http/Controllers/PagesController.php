<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function index()
    {
        $cate_product = DB::table('category')->orderBy('CategoryID', 'DESC')->get();
        $new_product = DB::table('product')->orderby('CreatedDate', 'desc')->limit(3)->get();
        $expen_product = DB::table('product')->orderby('Price', 'desc')->limit(3)->get();
        $iphone_product = DB::table('product')->where('ProductName', 'like', '%Iphone%')->limit(3)->get();
        $best_sell = DB::table('product')
            ->join('orderdetail', 'product.ProductID', '=', 'orderdetail.ProductID')
            ->select('product.Price', 'product.ProductName', 'product.Image', 'product.ProductID')
            ->orderby('orderdetail.amount', 'desc')->limit(4)->get();
        return view('client.index')->with('category', $cate_product)->with('newproduct', $new_product)->with('expenproduct', $expen_product)->with('iphoneproduct', $iphone_product)->with('bestsell', $best_sell);
    }
    public function indexcate($cateid)
    {
        $cate_product = DB::table('category')->get();
        $new_product = DB::table('product')->where('CategoryID', $cateid)->orderby('ProductID', 'desc')->limit(3)->get();
        $expen_product = DB::table('product')->where('CategoryID', $cateid)->orderby('Price', 'desc')->limit(3)->get();
        $iphone_product = DB::table('product')->where('CategoryID', $cateid)->where('ProductName', 'like', '%Iphone%')->limit(3)->get();
        return view('client.index')->with('category', $cate_product)->with('newproduct', $new_product)->with('expenproduct', $expen_product)->with('iphoneproduct', $iphone_product);
    }
    public function loadAllProduct()
    {
        $cate_product = DB::table('category')->get();
        $all_product = DB::table('product')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.product')->with('allproduct', $all_product)->with('allbrand', $all_brand)->with('category', $cate_product);
    }
    public function loadAllProductCate($cateid)
    {
        $cate_product = DB::table('category')->get();
        $all_product = DB::table('product')->where('CategoryID', $cateid)->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.product')->with('allproduct', $all_product)->with('allbrand', $all_brand)->with('category', $cate_product);
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
            ->join('productattribute', 'productattribute.ProductID', '=', 'product.ProductID')
            ->join('attribute', 'attribute.AttributeID', '=', 'productattribute.AttributeID')
            ->where('product.ProductID', '=', $product->ProductID)
            ->get();
        $category = DB::table('category')->orderBy('CategoryID', 'DESC')->get();
        return view('client.pages.productdetail', compact('category', 'product', 'attributes', 'attributevalues'));
    }

    public function ajaxAPICateID($id)
    {
        // dd($id);
        $cate_product = DB::table('category')->get();
        $new_product = DB::table('product')->where('CategoryID', $id)->orderby('ProductID', 'desc')->limit(3)->get();
        $expen_product = DB::table('product')->where('CategoryID', $id)->orderby('Price', 'desc')->limit(3)->get();
        $iphone_product = DB::table('product')->where('CategoryID', $id)->where('ProductName', 'like', '%Iphone%')->limit(3)->get();
        $all_product = DB::table('product')->where('CategoryID', $id)->get();
        $all_brand = DB::table('brand')->get();
        return response([
            'arrayCateProduct' => $cate_product,
            'arrayNewProductForID' => $new_product,
            'arrayExpenProductForID' => $expen_product,
            'arrayIPhoneProductForID' => $iphone_product,
            'arrayProductForID' => $all_product,
            'arrayAllBrand' => $all_brand
        ], 200);
    }
    public function searchProduct(Request $request)
    {
        $keyword = $request->keywords_submit;
        $cate_product = DB::table('category')->get();
        $search_product = DB::table('product')->where('ProductName', 'like', '%' . $keyword . '%')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.searchproduct')->with('allbrand', $all_brand)->with('category', $cate_product)->with('search_product', $search_product);
    }
    public function getListProduct(Request $request)
    {
        $keyword = $request->keywords_submit;
        $cate_product = DB::table('category')->get();
        $get_product = DB::table('product')->where('ProductName', 'like', '%' . $keyword . '%')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.searchproduct')->with('allbrand', $all_brand)->with('category', $cate_product)->with('get_product', $get_product);
    }
    public function filterProduct(Request $request)
    {
        $brands = $request->brand ?? [];
        $brand_ids = array_keys($brands);
        $get_product = DB::table('product')->get();
        $products = $brand_ids != null ? $get_product->whereIn('product.Brand_ID', $brand_ids)->get : $get_product;
        $cate_product = DB::table('category')->get();
        $all_brand = DB::table('brand')->get();
        return view('client.pages.product')->with('allproduct', $products)->with('allbrand', $all_brand)->with('category', $cate_product);
    }

    public function filterProductForPriceAndBrand(Request $request)
    {
        // dd($request);

        // if ($request->Brand_Check) {

        // }
        // $get_productBy = DB::table("product");
        $get_productByPrice = "";
        $all_brand = DB::table('brand')->get();
        $category = DB::table('category')->get();


        switch ($request->PriceCheck) {
            case 1:
                $get_productByPrice = DB::table("product")->whereBetween('Price', [0, 1000000])->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
            case 2:
                $get_productByPrice = DB::table("product")->whereBetween('Price', [1000000, 5000000])->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
            case 3:
                $get_productByPrice = DB::table("product")->whereBetween('Price', [5000000, 10000000])->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
            case 4:
                $get_productByPrice = DB::table("product")->whereBetween('Price', [10000000, 15000000])->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
            case 5:
                $get_productByPrice = DB::table("product")->whereBetween('Price', [15000000, 20000000])->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
            case 6:
                $get_productByPrice = DB::table("product")->where('Price', '>', 20000000)->get();
                return view('client.pages.product-by-price', compact('get_productByPrice', 'all_brand', 'category'));

                break;
        }

       
    }
}
