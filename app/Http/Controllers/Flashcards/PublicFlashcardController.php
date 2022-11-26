<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicFlashcardController extends Controller
{
    public function show(Request $request)
    {
        if (self::hasAccess($request->id))
            return view('flashcards.public-flashcard', ['id' => $request->id]);
        else
            return view('flashcards.public-flashcard-invalid');
    }

    public function getCards(Request $request)
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }

    public static function hasAccess($exercise_id)
    {
        if (self::getAccess($exercise_id) === 0)
            return false;
        else
            return true;
    }

    private static function getAccess($exercise_id)
    {
        return DB::table('exercises')
            ->select('*')
            ->where('id', '=', $exercise_id)
            ->where('visibility', '=', 'public')
            ->get()
            ->count();
    }
}
