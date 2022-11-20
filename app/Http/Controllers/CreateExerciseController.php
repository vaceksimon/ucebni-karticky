<?php



namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateExerciseController extends Controller
{
    public function index()
    {
        return view('create-exercise.create-exercise');
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
