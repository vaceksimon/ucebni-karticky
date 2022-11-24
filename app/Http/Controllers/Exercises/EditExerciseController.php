<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Flashcard;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ImageUploadController;

class EditExerciseController extends Controller
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

    public function index()
    {
        $exercise_id = Session::get('exercise_id');
        $exercise = Exercise::where('id', '=', $exercise_id)->get();

        $flashcards = Flashcard::where('exercise_id', '=', $exercise_id)->get();

        return view('exercises.edit-exercise')
            ->with('exercise', $exercise)
            ->with('flashcards', $flashcards);
    }

    public function store(Request $request)
    {
        Exercise::where('id', '=', $request->exercise_id)->update(['name' => $request->name, 'description' => $request->description]);

        return $this->index();
    }
}
