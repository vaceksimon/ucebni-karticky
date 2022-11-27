<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Controller for the show-group view.
 */
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

    /**
     * The index of the show-group view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Session::has('group_id'))
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
                    ->Select(DB::raw('ex.*, (SELECT COUNT(*) FROM flashcards AS fc WHERE ex.id = fc.exercise_id) AS pocet'))
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

        return view('home');
    }

    /**
     * Function for getting the assignments.
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getAssignments(Request $request) {
        return DB::table('exercises AS ex')
                ->join('assigned_exercises AS aex', 'ex.id', 'aex.exercise_id')
                ->where('aex.group_id', $request->group_id)
                ->Select(DB::raw('ex.*, (SELECT COUNT(*) FROM flashcards AS fc WHERE ex.id = fc.exercise_id) AS pocet'))
                ->get();
    }

    /**
     * Function for unassigning.
     *
     * @param Request $request
     * @return void
     */
    public function unassign(Request $request) {
        DB::table('assigned_exercises')
            ->select('*')
            ->where('group_id', $request->group_id)
            ->where('exercise_id', $request->exercise_id)
            ->delete();
    }

}
