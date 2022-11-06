<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function show_role()
    {
        $role = DB::select(DB::raw("SELECT RoleID,RoleName 
                                    FROM role
                                    "));
        return response()->json(['data' => $role], 200);
    }
}
