<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateGroupController extends Controller
{
    public function index()
    {
        return view('create-group.create-group');
    }

    public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '<>', 'admin')
                ->get();
        }
        else
        {
            $result = User::where('account_type', '<>', 'admin')->get();
        }

        return response()->json(['result' => $result]);
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $group = $user->groupsOwnerships()->create([
            'name' => $request->name,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        $group->save();

        return redirect('create-group')->with('status', 'Blog Post Form Data Has Been inserted');
    }
}
