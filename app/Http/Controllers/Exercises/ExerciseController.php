<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
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

    public function show()
    {
        return view('exercises.myexercises')
            ->with('role', Auth::user()->account_type)
            ->with('t_exercises', $this->t_getExercises())
            ->with('s_exercises', $this->s_getStudents());
    }

    public function t_getExercises()
    {
        return DB::table('exercises AS ex')
            ->select('*')
            ->addSelect(DB::raw('(SELECT COUNT(*)
                        FROM flashcards fs
                        WHERE fs.exercise_id = ex.id) AS pocet'))
            ->where('author', '=', Auth::user()->id)
            ->get();
    }

    public function s_getStudents()
    {
        return DB::table('users AS us')
            ->select(DB::raw('ex.id, ex.name AS e_name, ex.topic, gr.name AS g_name, ex.description'))
            ->addSelect(DB::raw('(
                SELECT COUNT(*) FROM exercises exin
	            JOIN flashcards fl on fl.exercise_id = exin.id
	            WHERE exin.id = ex.id) AS count'))
            ->join('users_memberships AS um', 'us.id', '=', 'um.user_id')
            ->join('groups AS gr', 'gr.id', '=', 'um.group_id')
            ->join('assigned_exercises AS ae', 'gr.id', '=', 'ae.group_id')
            ->join('exercises AS ex', 'ex.id', '=', 'ae.exercise_id')
            ->where('us.id', '=', Auth::user()->id)
            ->orderBy('g_name')
            ->orderBy('e_name')
            ->get();
    }

public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = Group::whereNotIn('groups.id', function ($query) use ($request) {
                $query->select('group_id')->from('assigned_exercises AS ae')->where('exercise_id', '=' , $request->exercise_id);
            })
                ->where('groups.owner', $request->owner_id)
                ->where('groups.type', 'students')
                ->where('groups.name', 'LIKE', "%".$request->keyword."%")
                ->get();
        }
        else
        {
            $result = Group::whereNotIn('groups.id', function ($query) use ($request) {
                $query->select('group_id')->from('assigned_exercises AS ae')->where('exercise_id', '=' , $request->exercise_id);
            })
                ->where('groups.owner', $request->owner_id)
                ->where('groups.type', 'students')
                ->get();
        }

        return response()->json(['result' => $result]);
    }

    public function store_assignment(Request $request) {
        DB::table('assigned_exercises')->insert(['exercise_id' => $request->exercise_id, 'group_id' => $request->group_id]);
    }
}
