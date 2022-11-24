<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Groups;

class ExerciseAdministrationController extends Controller
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

    public function index(Request $request)
    {
        return view('administration.exercise-administration');
    }

    public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = Exercise::where('name', 'LIKE', "%".$request->keyword."%")
                ->get();
        }
        else
        {
            $result = Exercise::all();
        }

        return response()->json(['result' => $result]);
    }

    public function removeExercise(Request $request)
    {
        DB::table('exercises')
            ->where('id', $request->exercise_id)
            ->delete();

        return view('administration.exercise-administration');
    }

    public function redirectToExercise(Request $request)
    {
        session(['exercise_id' => $request->exercise_id]);

        return redirect('edit-exercise');
    }
}
