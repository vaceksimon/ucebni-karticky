<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateGroupController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$name."%")->get();

        return view('create-group.create-group', compact('result'));
    }

    public function searchUser(Request $request)
    {
        $name = $request->name;
        $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$name."%")->get();

        //return dd($result);
        return view('create-group.create-group', compact('result'));
    }
}
