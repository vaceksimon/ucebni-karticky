<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\User;
use Exception;
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
            ->with('s_exercises', $this->s_getStudents())
            ->with('t_sharedExercises', $this->t_getSharedExercises());
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

    public function t_getSharedExercises()
    {
        return DB::table('exercises AS ex')
            ->select(DB::raw('ex.id, ex.name AS e_name, ex.topic, gr.name AS g_name, ex.description'))
            ->addSelect(DB::raw('(SELECT COUNT(*)
                        FROM flashcards fs
                        WHERE fs.exercise_id = ex.id) AS pocet'))
            ->join('shared_exercises AS se', 'se.exercise_id', '=', 'ex.id')
            ->join('groups AS gr', 'se.group_id', '=','gr.id')
            ->join('users_memberships AS um', 'um.group_id', '=', 'gr.id')
            ->join('users AS us', 'um.user_id', '=', 'us.id')
            ->where('us.account_type', '=', User::ROLE_TEACHER)
            ->where('us.id', '=', Auth::user()->id)
            ->where('ex.author', '!=', Auth::user()->id)
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

    public function edit(Request $request)
    {
        session(['exercise_id' => $request->id]);

        return redirect('edit-exercise');
    }

    public function share(Request $request) {
        if ($request->keyword != '')
        {
            $groups = DB::table('groups')
                ->where('groups.type', Group::TEACHERS_GROUP)
                ->where('groups.name', 'LIKE', "%".$request->keyword."%")
                ->get()
                ->toArray();
        }
        else
        {
            $groups = DB::table('groups')
                ->where('groups.type', Group::TEACHERS_GROUP)
                ->get()
                ->toArray();
        }

        $isShared = array();
        $counter = 0;
        $tmp = $groups;
        foreach ($groups as $group)
        {
            $count = DB::table('shared_exercises')
                ->where('group_id', '=', $group->id)
                ->where('exercise_id', '=', $request->exercise_id)
                ->count();

            if ($count !== 0)
                $isShared[$counter++]['shared'] = '1';
            else
                $isShared[$counter++]['shared'] = '0';
        }

        return response()->json(['result' => $tmp, 'isShared' => json_encode($isShared)]);
    }

    public function storeShare(Request $request) {
        try
        {
            $group = Group::find($request->group_id);
            $group->groupsSharing()->attach($request->exercise_id);
            return '1';
        }
        catch (Exception $e)
        {
            return '0';
        }
    }

    public function deleteShare(Request $request) {
        try
        {
            DB::table('shared_exercises')
                ->where('group_id', '=', $request->group_id)
                ->where('exercise_id', '=', $request->exercise_id)
                ->delete();
            return '1';
        }
        catch (Exception $e)
        {
            return '0';
        }
    }
}
