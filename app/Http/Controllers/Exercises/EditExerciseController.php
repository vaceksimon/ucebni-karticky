<?php

namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use App\Models\Exercise;
use App\Models\Flashcard;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\ImageUploadController;

/**
 * Controller for the edit-exercise view.
 */
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

    /**
     * The index of the edit-exercise view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Session::has('exercise_id'))
        {
            $exercise_id = Session::get('exercise_id');
            $exercise = Exercise::where('id', '=', $exercise_id)->get();

            return view('exercises.edit-exercise')
                ->with('exercise', $exercise);
        }

        return view('home');
    }

    public function searchFlashcards(Request $request)
    {
        $exercise_id = Session::get('exercise_id');
        $result = Flashcard::where('exercise_id', '=', $exercise_id)->get();

        return response()->json(['result' => $result]);
    }

    /**
     * Function for storing the exercise changes in the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        $show_timer = true;

        if (strcmp($request->show_timer, "show") !== 0)
        {
            $show_timer = false;
        }

        Exercise::where('id', '=', $request->exercise_id)->update(['name' => $request->name, 'topic' => $request->topic,
            'description' => $request->description, 'show_timer' => $show_timer]);

        if (Auth::user()->account_type == "admin")
        {
            return redirect('exercise-administration');
        }

        return redirect('myexercises');
    }

    /**
     * Function for removing flashcard from the exercise.
     *
     * @param Request $request
     * @return string
     */
    public function removeFlashcard(Request $request)
    {
        try {
            $flashcard_id = $request->flashcard_id;

            // Then remove the flashcard from the exercise.
            DB::table('flashcards')
                ->where('id', $flashcard_id)
                ->delete();
        } catch (Exception $e) {
            return '1';
        }

        return '0';
    }

    /**
     * Function for adding flashcard to the exercise.
     *
     * @param Request $request
     * @return string
     */
    public function addFlashcard(Request $request)
    {
        try {
            $validated = $request->validate([
                'flashcard_question' => 'required|max:255',
                'flashcard_answer' => 'required|max:255',
            ]);

            $question = $validated['flashcard_question'];
            $answer = $validated['flashcard_answer'];
            $exercise_id = $request->add_flashcard_exercise_id;

            $exercise = Exercise::find($exercise_id);

            $exercise->flashcards()->create([
                'question' => $question,
                'answer' => $answer,
            ]);

            $exercise->save();
        } catch (Exception $e) {
            return '1';
        }

        return '0';
    }

    /**
     * Function for deleting the whole exercise from the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deleteExercise(Request $request)
    {
        DB::table('exercises')
            ->where('id', $request->exercise_id)
            ->delete();

        if (Auth::user()->account_type != 'admin')
        {
            $exerciseController = new ExerciseController();
            return $exerciseController->show();
        }

        return view('administration.exercise-administration');
    }

    /**
     * Function for editing the content of the flashcard.
     *
     * @param Request $request
     */
    public function editFlashcard(Request $request)
    {
        try {
            $validated = $request->validate([
                'flashcard_question_edit' => 'required|max:255',
                'flashcard_answer_edit' => 'required|max:255',
            ]);

            // Then update the flashcard question and answer.
            DB::table('flashcards')
                ->where('id', '=', $request->flashcard_id_edit)
                ->update(['question' => $validated['flashcard_question_edit'], 'answer' => $validated['flashcard_answer_edit']]);
        } catch (Exception $e) {
            return '1';
        }

        return '0';
    }
}
