<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EditGroupController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $group_id = Session::get('group_id');
        $group = Group::where('id', '=', $group_id)->get();

        $members = User::leftJoin('users_memberships', function($join) {
                $join->on('users.id', '=', 'users_memberships.user_id');
            })->whereNotIn('user_id', function ($query) use ($group_id) {
                $query->select('owner')->from('groups')->where('groups.id', '=', $group_id);
            })->where('users_memberships.group_id', '=', $group_id)->get();

        return view('groups.edit-group')
            ->with('group', $group)
            ->with('members', $members);
    }

    public function search(Request $request)
    {
        $account_type = rtrim($request->group_type, "s");

        if ($request->keyword != '')
        {
            $result = User::whereNotIn('users.id', function ($query) use ($request) {
                    $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
                })->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '=', $account_type)
                ->get();
        }
        else
        {
            $result = User::whereNotIn('users.id', function ($query) use ($request) {
                    $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
                })->where( 'account_type', '=', $account_type)->get();
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
        ]);

        $group->save();

        return redirect('edit-group')->with('status', 'Post Form Data Has Been inserted');
    }

    public function removeMember(Request $request)
    {
        $member_id = $request->member_id;
        $group_id = $request->group_id;

        DB::table('users_memberships')
            ->where('user_id', $member_id)
            ->where('group_id', $group_id)
            ->delete();

        return redirect('edit-group')->with('status', 'Post Form Data Has Been inserted');
    }

    public function addMember(Request $request)
    {
        $user_id = $request->new_user_id;
        $group_id = $request->new_user_group_id;

        DB::insert('insert into users_memberships (user_id, group_id) values (?, ?)', [$user_id, $group_id]);

        return redirect('edit-group')->with('status', 'Post Form Data Has Been inserted');
    }
}
