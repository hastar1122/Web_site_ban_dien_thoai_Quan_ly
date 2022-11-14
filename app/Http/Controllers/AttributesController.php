<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attributes = DB::table('attribute')->orderByDesc('ModifiedDate')->get();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Hàm load danh sách thuộc tính
     */
    public function listAttribute(Request $request) {
        $attributes = DB::table('attribute')->orderByDesc('ModifiedDate')->get();
        return view('admin.attributes.listAttribute')->with('attributes', $attributes);
    }

    /**
     * Hàm thêm mới thuộc tính
     */
    public function store(Request $request)
    {
        try {
            DB::table('attribute')->insert([
                'AttributeName' => $request->input('AttributeName'),
                'CreatedDate'=> Carbon::now(),
                'ModifiedDate'=> Carbon::now(),
            ]);
            return Response()->json(true, 200);
        }
        catch (Exception $ex) {
            return Response()->json(false, 200);
        }
    }

    /**
     * Hàm lấy thông tin thuộc tính theo ID
     */
    public function show($id)
    {
        try {
            $attribute = DB::table('attribute')->where('AttributeID', '=', $id)->first();
            return Response()->json(['data' => $attribute], 200);
        }
        catch (Exception $ex) {
            return Response()->json(false, 200);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::table('attribute')->where('AttributeID', '=', $request->input('AttributeID'))->update([
                'AttributeName' => $request->input('AttributeName'),
                'ModifiedDate' => Carbon::now()
            ]);
            return Response()->json(true, 200);
        }
        catch (Exception $ex) {
            return Response()->json(false, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::table('attribute')->where('AttributeID', $id)->delete();
            return Response()->json(true, 200);
        }
        catch (Exception $ex) {
            return Response()->json(false, 200);
        }
    }
}
