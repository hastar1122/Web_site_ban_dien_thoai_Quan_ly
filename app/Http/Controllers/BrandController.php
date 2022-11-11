<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function add_brand(Request $request)
    {
        $data = array();
        $data['BrandName'] = $request->brandname;
        if ($request->brandparent !== "") {
            $data['BrandParentID'] = $request->brandparent;
        }
        $check = DB::table('brand')->insert($data);
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function all_brand()
    {
        $all_brand_get = DB::table('brand as b')
            ->select(DB::raw('b.BrandID,b.BrandName,m.BrandName as BrandParentID'))
            ->leftJoin('brand as m', 'b.BrandParentID', '=', 'm.BrandID')
            ->paginate(5);
        if ($key = request()->brand_search) {
            $all_brand_get = DB::table('brand as b')
                ->select(DB::raw('b.BrandID,b.BrandName,m.BrandName as BrandParentID'))
                ->leftJoin('brand as m', 'b.BrandParentID', '=', 'm.BrandID')
                ->where('b.BrandName', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view('admin.pages.all_brand', compact('all_brand_get'));
    }
    public function delete_brand($brand_id)
    {
        $check = DB::table('brand')->where('BrandID', $brand_id)->delete();
        if ($check) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
    public function show_brand()
    {
        $brand = DB::select(DB::raw("SELECT BrandID,BrandName 
                                    FROM brand
                                    "));
        return response()->json(['data' => $brand], 200);
    }

    public function edit_brand($brand_id)
    {
        $brand_get_id = DB::select(DB::raw(" select BrandID,BrandName,BrandParentID from brand where BrandID=$brand_id"));
        $brand = DB::select(DB::raw("SELECT BrandID,BrandName 
        FROM brand
        "));
        return response()->json(['data' => $brand, 'brand_get' => $brand_get_id], 200);
    }
    public function update_brand(Request $request, $brand_id)
    {
        if ($request->brand_parent === "") {
            $brand = DB::table('brand')
                ->where('BrandID', $brand_id)
                ->update([
                    'BrandName' => $request->brand_name,
                ]);
            if ($brand) {
                return response()->json(null, 204);
            } else
                return response()->json(null, 400);
        }
        $brand = DB::table('brand')
            ->where('BrandID', $brand_id)
            ->update([
                'BrandParentID' => $request->brand_parent,
                'BrandName' => $request->brand_name,
            ]);
        if ($brand) {
            return response()->json(null, 204);
        } else
            return response()->json(null, 400);
    }
}