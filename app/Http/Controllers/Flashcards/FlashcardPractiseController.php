<?php
/***********************************************************/
/*                                                         */
/* File: FlashcardPractiseController.php                   */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Controller for Flashcard practise views    */
/*                                                         */
/***********************************************************/
namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FlashcardPractiseController extends Controller
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
     * Function which return view of flashcards practise if user has access to it else return error page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        if (FlashcardController::hasAccess($request->id))
            return view('flashcards.flashcardPractise', ['id' => $request->id])
                ->with('role', Auth::user()->account_type);
        else
            return view('flashcards.flashcard-invalid');
    }

    public function isTimerVisible(Request $request)
    {
        return DB::table('exercises')
            ->select('show_timer')
            ->where('id', '=', $request->id)
            ->get();
    }
}
