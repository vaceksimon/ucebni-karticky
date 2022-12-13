<?php
/***********************************************************/
/*                                                         */
/* File: PublicFlashcardPractiseController.php             */
/* Author: Tomas Bartu <xbartu11@stud.fit.vutbr.cz>        */
/* Project: Project for the course ITU                     */
/* Description: Controller for Flashcard public practise   */
/*              views                                      */
/*                                                         */
/***********************************************************/
namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PublicFlashcardPractiseController extends Controller
{

    /**
     * Function which return view of public flashcards practise if user has access to it else return error page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        if (PublicFlashcardController::hasAccess($request->id))
            return view('flashcards.public-flashcardPractise', ['id' => $request->id]);
        else
            return view('flashcards.public-flashcard-invalid');
    }
}
