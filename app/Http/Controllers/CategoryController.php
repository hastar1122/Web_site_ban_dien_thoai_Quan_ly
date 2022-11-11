<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add_category(Request $request)
    {
        $data = array();
        $data['ProductCategoryName'] = $request->categoryname;
        if ($request->brandparent !== "") {
            $data['CategoryParentID'] = $request->categoryparent;
        }
        $check = DB::table('category')->insert($data);
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function all_category()
    {
        $all_category_get = DB::table('category as b')
            ->select(DB::raw('b.CategoryID,b.ProductCategoryName,m.ProductCategoryName as CategoryParent'))
            ->leftJoin('category as m', 'b.CategoryParentID', '=', 'm.CategoryID')
            ->paginate(6);
        if ($key = request()->category_search) {
            $all_category_get = DB::table('category as b')
                ->select(DB::raw('b.CategoryID,b.ProductCategoryName,m.ProductCategoryName as CategoryParent'))
                ->leftJoin('category as m', 'b.CategoryParentID', '=', 'm.CategoryID')
                ->where('b.ProductCategoryName', 'like', '%' . $key . '%')
                ->paginate(6);
        }
        return view('admin.pages.all_category', compact('all_category_get'));
    }
    public function delete_category($category_id)
    {
        $check = DB::table('category')->where('CategoryID', $category_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function show_category()
    {
        $category = DB::select(DB::raw("SELECT  CategoryID,ProductCategoryName 
                                    FROM category
                                    "));
        return response()->json(['data' => $category], 200);
    }
    public function edit_category($category_id)
    {
        $category_get_id = DB::select(DB::raw(" select CategoryID,ProductCategoryName,CategoryParentID from category where CategoryID=$category_id"));
        $category = DB::select(DB::raw("SELECT CategoryID,ProductCategoryName 
        FROM category
        "));
        return response()->json(['data' => $category, 'category_get' => $category_get_id], 200);
    }
    public function update_category(Request $request, $category_id)
    {
        if ($request->category_parent === "") {
            $category = DB::table('category')
                ->where('CategoryID', $category_id)
                ->update([
                    'ProductCategoryName' => $request->category_name,
                ]);
            if ($category) {
                return response()->json(null, 204);
            } else
                return response()->json(null, 400);
        }
        $category = DB::table('category')
            ->where('CategoryID', $category_id)
            ->update([
                'CategoryParentID' => $request->category_parent,
                'ProductCategoryName' => $request->category_name,
            ]);
        if ($category) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
}
