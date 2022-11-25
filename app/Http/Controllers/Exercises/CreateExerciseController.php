<?php



namespace App\Http\Controllers\Exercises;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateExerciseController extends Controller
{
    public function index()
    {
        return view('exercises.create-exercise');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $exercise = $user->createdExercises()->create([
        'name' => $request->name,
        'description' => $request->description,
        'visibility' => $request->visibility,
        ]);

        $exercise->save();

        return redirect('create-exercise')->with('status', 'Post Form Data Has Been inserted');
    }

}
