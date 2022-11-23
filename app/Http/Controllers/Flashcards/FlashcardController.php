<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
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

    public function show()
    {
        return view('flashcards.flashcard')
            ->with('flashcard_set', $this->getFlashcardSet());
    }

    public function getFlashcardSet()
    {
        return DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', 1)
            ->get();
    }

    public function getCards()
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', 1)
            ->get();
        return $cards;
    }
}
