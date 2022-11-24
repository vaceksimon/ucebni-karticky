<?php

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

    public function show(Request $request)
    {
        if (FlashcardController::hasAccess($request->id))
            return view('flashcards.flashcardPractise', ['id' => $request->id])
                ->with('role', Auth::user()->account_type);
        else
            return view('flashcards.flashcard-invalid');
    }
}
