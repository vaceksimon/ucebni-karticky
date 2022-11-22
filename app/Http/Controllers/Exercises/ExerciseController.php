<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
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
                SELECT COUNT(*) FROM ucebny_karticky.exercises exin
	            JOIN ucebny_karticky.flashcards fl on fl.exercise_id = exin.id
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

}
