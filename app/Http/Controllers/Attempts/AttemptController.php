<?php

namespace App\Http\Controllers\Attempts;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttemptController extends Controller
{
    /**
     * Function to save attempt to database.
     *
     * @param Request $request
     * @return string '1' if everything is OK else return error message
     */
    public function saveAttempt(Request $request)
    {
        try
        {
            $attempt = new Attempt();
            $attempt->user_id = Auth::user()->id;
            $attempt->exercise_id = $request->exercise_id;
            $attempt->correct_answers_number = $request->correctCount;
            $attempt->wrong_answers_number = $request->wrongCount;
            $attempt->spend_time = $request->timer;
            $attempt->save();
            return "1";
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
}
