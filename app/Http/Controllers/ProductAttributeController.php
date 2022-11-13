<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryAttribute;
use Attribute;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\List_;

class ProductAttributeController extends Controller
{

    public function show_catogory_product($id) {
        $all_category = Category::all();
        $all_attr_product = DB::table('categoryattribute')
        ->join('attribute', 'categoryattribute.AttributeID', '=', 'attribute.AttributeID')
        ->where('CategoryID', '=', $id)
        ->get();

        //những đặc trưng chưa thêm vào sản phẩm
        $arr = array();
        $i = 0;
        foreach($all_attr_product as $attr){
            $arr[$i] = $attr->AttributeID;
            $i += 1;
        }
        $all_attr_no_add = DB::table('attribute')->whereNotIn('AttributeID', $arr)->get();
        // dd($all_attr_not_add);
        return view('admin.pages.attribute-product.index')->with(compact('all_category', 'all_attr_product', 'id','all_attr_no_add'));
    }

    public function update_product_attr(Request $request, $id) {
        $empData = [
            'CategoryID' => $id,
            'AttributeID' => $request->attr_id,
        ];

        $check = DB::table('categoryattribute')->insert($empData);
        if ($check) {
            return response()->json(null, 204);
        } else {
            return response()->json(null, 400);
        }

    }

    public function delete_product_attr(Request $request, $id) {
        $check = DB::table('categoryattribute')->where('CategoryID', $request->value)->where('AttributeID', $id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else {
            return response()->json(null, 400);
        }
    }
}
