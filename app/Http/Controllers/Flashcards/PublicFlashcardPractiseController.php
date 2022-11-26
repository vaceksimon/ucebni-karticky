<?php

namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicFlashcardPractiseController extends Controller
{
    public function show(Request $request)
    {
        if (PublicFlashcardController::hasAccess($request->id))
            return view('flashcards.public-flashcardPractise', ['id' => $request->id]);
        else
            return view('flashcards.public-flashcard-invalid');
    }
}
