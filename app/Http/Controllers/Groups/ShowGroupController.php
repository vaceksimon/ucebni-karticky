<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ShowGroupController extends Controller
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

    public function index()
    {
        $group_id = Session::get('group_id');
        $group = Group::where('id', '=', $group_id)->get();

        $members = User::leftJoin('users_memberships', function($join) {
            $join->on('users.id', '=', 'users_memberships.user_id');
        })->whereNotIn('user_id', function ($query) use ($group_id) {
            $query->select('owner')->from('groups')->where('groups.id', '=', $group_id);
        })->where('users_memberships.group_id', '=', $group_id)->get();

        if($group->first()->type == 'students') {
            $assigned_exc = DB::table('exercises AS ex')
                ->join('assigned_exercises AS aex', 'ex.id', 'aex.exercise_id')
                ->where('aex.group_id', $group_id)
                ->select('ex.*')
                ->get();

            return view('groups.show-group')
                ->with('group', $group)
                ->with('members', $members)
                ->with('exercises', $assigned_exc);
        }


        return view('groups.show-group')
            ->with('group', $group)
            ->with('members', $members);
    }
}
