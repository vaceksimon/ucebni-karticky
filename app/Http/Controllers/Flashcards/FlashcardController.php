<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return view('flashcards.flashcard', ['id' => $request->id]);
    }

    public function getCards(Request $request)
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }
}
