<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;
use App\Models\Exercise;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Groups;

/**
 * Controller for the exercise-administration view.
 */
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

    /**
     * The index of the exercise-administration view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('administration.exercise-administration');
    }

    /**
     * Function for dynamic searching of the exercises in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Function for removing the exercises from the database.
     *
     * @param Request $request
     * @return string
     */
    public function removeExercise(Request $request)
    {
        try {
            DB::table('exercises')
                ->where('id', $request->exercise_id)
                ->delete();
        } catch (Exception $e) {
            return '1';
        }

        return '0';
    }

    /**
     * Function for redirecting from the exercise administration page
     * to the specific exercise.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToExercise(Request $request)
    {
        session(['exercise_id' => $request->exercise_id]);

        return redirect('edit-exercise');
    }
}
