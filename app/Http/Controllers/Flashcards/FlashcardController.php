<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlashcardController extends Controller
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

    public function show(Request $request)
    {
        if ($this->hasAccess(Auth::user()->id, $request->id))
            return view('flashcards.flashcard', ['id' => $request->id]);
        else
            return view('flashcards.flashcard-invalid');
    }

    public function getCards(Request $request)
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }

    public static function hasAccess($user_id, $exercise_id) {
        $teacher = DB::table('exercises')
            ->select('*')
            ->where('id', '=', $exercise_id)
            ->where('author', '=', $user_id)
            ->get()->count();

        $students = DB::table('users AS us')
            ->select('*')
            ->join('users_memberships AS um', 'us.id', '=', 'um.user_id')
            ->join('groups AS gr', 'gr.id', '=', 'um.group_id')
            ->join('assigned_exercises AS ae', 'gr.id', '=', 'ae.group_id')
            ->join('exercises AS ex', 'ex.id', '=', 'ae.exercise_id')
            ->where('gr.type', '=', 'students')
            ->where('ex.id', '=', $exercise_id)
            ->where('us.id', '=', $user_id)
            ->get()
            ->count();

        return !($teacher === 0 && $students === 0);
    }
}
