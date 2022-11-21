<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditGroupController extends Controller
{
    public function index()
    {
        // TODO zmenit na spravny
        $group = Group::where('id', '=', '1')->get();// Table::select('name','surname')->where('id', 1)->get();

        //SELECT * FROM ucebni_karticky.users LEFT JOIN users_memberships ON users.id = users_memberships.user_id WHERE users_memberships.group_id = 1;
        // TODO zmenit na spravny
        $members = DB::table('users')
            ->leftJoin('users_memberships', 'users.id', '=', 'users_memberships.user_id')
            ->where('users_memberships.group_id', '=', '1')
            ->get();

        return view('groups.edit-group')
            ->with('group', $group)
            ->with('members', $members);
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
            'description' => $request->description,
            'type' => $request->type,
            'visibility' => $request->visibility,
        ]);

        $group->save();

        return redirect('edit-group')->with('status', 'Post Form Data Has Been inserted');
    }
}
