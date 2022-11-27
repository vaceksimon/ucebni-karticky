<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicFlashcardController extends Controller
{
    /**
     * Function which return view of public flashcards if user has access to it else return error page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        if (self::hasAccess($request->id))
            return view('flashcards.public-flashcard', ['id' => $request->id]);
        else
            return view('flashcards.public-flashcard-invalid');
    }

    /**
     * Function which return all flashcards in exercises
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getCards(Request $request)
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }

    /**
     * Function to check if user has access to flashcards set
     *
     * @param $exercise_id
     * @return bool True if user has access else return false
     */
    public static function hasAccess($exercise_id)
    {
        if (self::getAccess($exercise_id) === 0)
            return false;
        else
            return true;
    }

    /**
     * @param $exercise_id
     * @return int How many flashcards exercises has user access
     */
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
