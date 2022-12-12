<?php



namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Controller for the create-exercise view.
 */
class CreateExerciseController extends Controller
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
     * The index of the create-exercise view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('exercises.create-exercise');
    }

    /**
     * Function for storing the new exercise in the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $exercise = $user->createdExercises()->create([
        'name' => $request->name,
        'topic' => $request->topic,
        'description' => $request->description,
        'visibility' => $request->visibility,
        ]);

        $exercise->save();

        return redirect('myexercises')->with('status', 'Post Form Data Has Been inserted');
    }

}
