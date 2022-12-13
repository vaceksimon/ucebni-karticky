<?php

namespace App\Http\Controllers\Statistics;

/**********************************************************/
/*                                                        */
/* File: UserStatisticsController.php                     */
/* Author: Simon Vacek <xvacek10@stud.fit.vutbr.cz>       */
/* Project: Project for the course ITU                    */
/* Description: Controller for the user-statistics view.  */
/*                                                        */
/**********************************************************/

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Exercise;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Controller for the user-statistics view.
 */
class UserStatisticsController extends Controller
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
     * The index of the user-statistics view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Session::has('user_id') && Session::has('exercise_id'))
        {
            $user_id = Session::get('user_id');
            $exercise_id = Session::get('exercise_id');

            $user = User::where('id', '=', $user_id)
                ->get()
                ->first();

            $exercise = DB::table('exercises AS ex')
                ->where('ex.id', $exercise_id)
                ->Select(DB::raw('*, (SELECT COUNT(*) FROM flashcards AS fc WHERE ex.id = fc.exercise_id) AS count'))
                ->get()
                ->first();

            return view('statistics.user-statistics')
                ->with('user', $user)
                ->with('exercise', $exercise)
                ->with('fastest_attempt', $this->fastestAttempt($user_id, $exercise_id))
                ->with('best_attempt', $this->mostSuccessfulAttempt($user_id, $exercise_id))
                ->with('chart_data', $this->chartData($user_id, $exercise_id));
        }

        return view('home');
    }

    /**
     * Returns the fastest attempt for the provided user and exercise.
     *
     * @param $user_id
     * @param $exercise_id
     * @return mixed
     */
    public function fastestAttempt($user_id, $exercise_id)
    {
        // SELECT * FROM ucebni_karticky.attempts WHERE user_id = '2' AND exercise_id = '14' order by spend_time limit 1;
        $fastest_attempt = DB::table('attempts')
            ->select('*',
                DB::raw('(correct_answers_number / (correct_answers_number + wrong_answers_number) * 100) as success_rate'))
            ->where('user_id', '=', $user_id)
            ->where('exercise_id', '=', $exercise_id)
            ->orderBy('spend_time')
            ->limit(1)
            ->get()
            ->first();

        return $fastest_attempt;
    }

    /**
     * Returns the most successful attempt for the provided user and exercise.
     *
     * @param $user_id
     * @param $exercise_id
     * @return mixed
     */
    public function mostSuccessfulAttempt($user_id, $exercise_id)
    {
        // SELECT *,  correct_answers_number / (correct_answers_number + wrong_answers_number) * 100 as success_rate FROM ucebni_karticky.attempts WHERE user_id = '2' AND exercise_id = '14' order by success_rate desc limit 1;
        $most_successful_attempt = DB::table('attempts')
            ->select('*',
                DB::raw('(correct_answers_number / (correct_answers_number + wrong_answers_number) * 100) as success_rate'))
            ->where('user_id', '=', $user_id)
            ->where('exercise_id', '=', $exercise_id)
            ->orderBy('success_rate', 'DESC')
            ->limit(1)
            ->get()
            ->first();

        return $most_successful_attempt;
    }

    /**
     * Retrieves and transforms data of all exercise attempts which are relevant to a chart.
     *
     * @param $user_id
     * @param $exercise_id
     * @return array
     */
    public function chartData($user_id, $exercise_id)
    {
        $array_size = 11;
        $result_data = array_fill(0, $array_size, 0);

        // SELECT COUNT(*) as count, truncate(correct_answers_number / (correct_answers_number + wrong_answers_number), 1) * 100  as success_rate FROM ucebni_karticky.attempts WHERE user_id = '2' AND exercise_id = '14' GROUP BY success_rate ORDER BY success_rate;
        $chart_data = DB::table('attempts')
            ->select(DB::raw('COUNT(*) as count'),
                DB::raw('truncate(correct_answers_number / (correct_answers_number + wrong_answers_number), 1) * 100  as success_rate'))
            ->where('user_id', '=', $user_id)
            ->where('exercise_id', '=', $exercise_id)
            ->groupBy('success_rate')
            ->orderBy('success_rate')
            ->get();

        foreach ($chart_data as $data)
        {
            /*
             * Explanation: the field is pre-populated with 0 at indices 0-10.
             * Each position represents a percentage of success:
             *
             * 0 -> 0%
             * 1 -> 10%
             * 2 -> 20%
             * ...
             * 10 -> 100%
             *
             * So, for example, for 70%, the index is: 70/10 = 7.
             */
            $result_data[$data->success_rate / 10] = $data->count;
        }

        return $result_data;
    }
}
