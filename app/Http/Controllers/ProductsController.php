<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Lấy ra danh sách sản phẩm
        $products = DB::table('product')
        ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
        ->join('category','category.CategoryID', '=', 'product.CategoryID')
        // ->where('product.ProductParentID', '=', null)
        ->get();
        // Lấy ra danh sách loại sản phẩm
        $categorys = DB::table('category')->get();
        return view('admin.products.index', compact('products','categorys'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Lấy ra danh sách các thuộc tính theo từng loại sản phẩm
        $variations = DB::table('variation')
            ->join('categoryvariation', 'variation.VariationID', '=', 'categoryvariation.VariationID')
            ->join('category', 'category.CategoryID', '=', 'categoryvariation.CategoryID')
            ->where('category.CategoryID', '=', 1)
            ->select('VariationName', 'variation.VariationID')
            ->get();
        // Lấy ra danh sách thương hiệu
        $brands = DB::table('brand')->get();
        // Lấy ra danh sách loại sản phẩm
        $categorys = DB::table('category')->get();
        return view('admin.products.create2', compact('variations','brands','categorys'));
    }


    public function config_create(Request $request) {
        $categoryID = $request['categoryID'];
        // Lấy ra danh sách các thuộc tính theo từng loại sản phẩm
        $variations = DB::table('variation')
            ->join('categoryvariation', 'variation.VariationID', '=', 'categoryvariation.VariationID')
            ->join('category', 'category.CategoryID', '=', 'categoryvariation.CategoryID')
            ->where('category.CategoryID', '=', $categoryID)
            ->select('VariationName', 'variation.VariationID')
            ->get();
        // Lấy ra danh sách thương hiệu
        $brands = DB::table('brand')->get();
        // Lấy ra danh sách loại sản phẩm
        $categorys = DB::table('category')->get();
        return view('admin.products.create2', compact('variations','brands','categorys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Biến lưu tất cả thông tin request
        $data = $request->all();
        $imageFiles = array();
        /// 3. Tạo danh sách image cho từng phân loại
        if (is_array($data['ImageFiles'])) {
            for ($i = 0; $i < count($data['price']); $i++) {
                if ($data['ImageFiles'][$i]) {
                    array_push($imageFiles, $data['ImageFiles'][$i]);
                }
                    
            }
        }
        // Biến lưu hình ảnh của sản phẩm cha
        $imgParentProduct = null;
        if (array_key_exists('ImageFile', $data)) {
            $imgParentProduct = 'imgParentProduct'.time().'-.'.$data['ImageFile']->extension();
            $data['ImageFile']->move(public_path('imgProduct'),$imgParentProduct);
        }
        // Insert sản phẩm cha và lấy ra id sản phẩm vừa được insert
        $productId = DB::table('product')->insertGetId(
            [ 
                'ProductCode' => $data['ProductCode'],
                'ProductName' => $data['ProductCode'],
                'CategoryID' => $data['CategoryID'],
                'BrandID' => $data['BrandID'],
                'Price' => $data['Price'],
                'OutwardPrice' => $data['OutwardPrice'],
                'ProductDescription' => $data['ProductDescription'],
                'Amount' => $data['Amount'],
                'Image' => $imgParentProduct,
            ]
        );

        // Lấy ra danh sách các thuộc tính chung của loại sản phẩm đang được thêm mới
        $variations = DB::table('variation')
            ->join('categoryvariation', 'variation.VariationID', '=', 'categoryvariation.VariationID')
            ->join('category', 'category.CategoryID', '=', 'categoryvariation.CategoryID')
            ->where('category.CategoryID', '=', $data['CategoryID'])
            ->where('variation.ProductID', '=', null)
            ->select('variation.VariationID')
            ->get();

        // Insert thông tin chi tiết của sản phẩm theo từng thuộc tính
        for ($i = 0; $i < count($variations) ; $i++) {
            DB::table('productvariation')->insert(
                [ 
                    'ProductID' => $productId,
                    'VariationID' => $variations[$i]->VariationID,
                    'Value' => $data['AttributeValue'][$i],
                ]
            );
        }

        // Insert phân loại
        $VariationNewID = array();
        /// 1. Insert phân loại
        if ($data['VariationName1']) {
            $VariationName1ID = DB::table('variation')->insertGetId([
                'ProductID' => $productId,
                'VariationName' => $data['VariationName1'],
            ]);
            array_push($VariationNewID, $VariationName1ID);
        }
        if ($data['VariationName2']) {
            $VariationName2ID = DB::table('variation')->insertGetId([
                'ProductID' => $productId,
                'VariationName' => $data['VariationName2'],
            ]);
            array_push($VariationNewID, $VariationName2ID);
        }

        /// 2. Tạo danh sách giá trị các phân loại của từng sản phẩm con
        $variationValue = array();
        for ($i = 0; $i < count($data['Value']); $i++){
            for ($y = 0; $y < count($data['Value2']); $y++){
                array_push($variationValue, array($data['Value'][$i],$data['Value2'][$y]));
            }
        }

        

        // Thêm các sản phẩm phân loại
        for ($i = 0; $i < count($data['price']); $i++) {
            $productChild = new Product();
            $productChild['Price'] =  $data['price'][$i];
            $productChild['Amount'] =  $data['amount'][$i];
            $productChild['OutwardPrice'] = $data['OutwardPrice'];
            $productChild['Image'] = $data['ImageFiles'][$i];
            dd($productChild);
            
        }

        // Insert
        return Redirect::to('products');
    }

    /**
     * Hàm insert các sản phẩm con
     */
    public function insertChildProduct($productParentID, $productChild, $variations, $variationValue) {
        // $imgParentProduct = null;
        // if (array_key_exists('ImageFile', $data)) {
        //     $imgParentProduct = 'imgParentProduct'.time().'-.'.$data['ImageFile']->extension();
        //     $data['ImageFile']->move(public_path('imgProduct'),$imgParentProduct);
        // }
        // // Insert sản phẩm cha và lấy ra id sản phẩm vừa được insert
        // $productId = DB::table('product')->insertGetId(
        //     [ 
        //         'ProductCode' => $data['ProductCode'],
        //         'ProductName' => $data['ProductCode'],
        //         'CategoryID' => $data['CategoryID'],
        //         'BrandID' => $data['BrandID'],
        //         'Price' => $data['Price'],
        //         'OutwardPrice' => $data['OutwardPrice'],
        //         'ProductDescription' => $data['ProductDescription'],
        //         'Amount' => $data['Amount'],
        //         'Image' => $imgParentProduct,
        //     ]
        // );

        // // Lấy ra danh sách các thuộc tính chung của loại sản phẩm đang được thêm mới
        // $variations = DB::table('variation')
        //     ->join('categoryvariation', 'variation.VariationID', '=', 'categoryvariation.VariationID')
        //     ->join('category', 'category.CategoryID', '=', 'categoryvariation.CategoryID')
        //     ->where('category.CategoryID', '=', $data['CategoryID'])
        //     ->where('variation.ProductID', '=', null)
        //     ->select('variation.VariationID')
        //     ->get();

        // // Insert thông tin chi tiết của sản phẩm theo từng thuộc tính
        // for ($i = 0; $i < count($variations) ; $i++) {
        //     DB::table('productvariation')->insert(
        //         [ 
        //             'ProductID' => $productId,
        //             'VariationID' => $variations[$i]->VariationID,
        //             'Value' => $data['AttributeValue'][$i],
        //         ]
        //     );
        // }
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = DB::table('product')
            ->join('brand', 'brand.BrandID', '=', 'product.BrandID')
            ->join('category','category.CategoryID', '=', 'product.CategoryID')
            ->where('ProductID',$id)
            ->first();
        $variations = DB::table('variation')
            ->join('categoryvariation', 'variation.VariationID', '=', 'categoryvariation.VariationID')
            ->join('category', 'category.CategoryID', '=', 'categoryvariation.CategoryID')
            ->where('category.CategoryID', '=', $product->CategoryID)
            ->select('VariationName', 'variation.VariationID')
            ->get();
        $brands = DB::table('brand')->get();
        $categorys = DB::table('category')->get();
        $attributevalues = DB::table('productvariation')
            ->join('variation','variation.VariationID', '=', 'productvariation.VariationID')
            ->where('productvariation.ProductID', '=', $id)
            ->where('variation.ProductID', '=', null)
            ->get();
        return view('products.edit', compact('product', 'variations', 'brands','categorys','attributevalues'));
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
