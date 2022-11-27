<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Exercise;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupStatisticsController extends Controller
{
    public function index(Request $request) {
        $exercise = DB::table('exercises AS ex')
            ->where('ex.id', $request->exercise_id)
            ->Select(DB::raw('*, (SELECT COUNT(*) FROM flashcards AS fc WHERE ex.id = fc.exercise_id) AS count'))
            ->get()
            ->first();

        $group = Group::where('id', $request->group_id)
            ->get()
            ->first();

        $fastestAttempt = Attempt::whereIn('attempts.user_id', function ($query) use ($request) {
            $query->select('user_id')->from('users_memberships AS um')->where('um.group_id', $request->group_id);
        })
            ->select('*')
            ->addSelect(DB::raw('(SELECT (a.correct_answers_number / (a.correct_answers_number + a.wrong_answers_number) * 100) FROM attempts AS a WHERE a.id = attempts.id) AS percentage'))
            ->where('exercise_id', $request->exercise_id)
            ->orderBy('spend_time')->limit(3)
            ->get();

        $bestAttempt = Attempt::whereIn('attempts.user_id', function ($query) use ($request) {
            $query->select('user_id')->from('users_memberships AS um')->where('um.group_id', $request->group_id);
        })
            ->select('*')
            ->addSelect(DB::raw('(SELECT (a.correct_answers_number / (a.correct_answers_number + a.wrong_answers_number) * 100) FROM attempts AS a WHERE a.id = attempts.id) AS percentage'))
            ->where('exercise_id', $request->exercise_id)
            ->orderByDesc('correct_answers_number')->limit(3)
            ->get();

        return view('statistics.group-statistics',
            ['exercise' => $exercise,
                'group' => $group,
                'fastest_attempt' => $fastestAttempt,
                'best_attempt' => $bestAttempt,
                'chart_data' => $this->chartData($request->group_id, $request->exercise_id)]);
    }

    public function chartData($group_id, $exercise_id)
    {
        $array_size = 11;
        $result_data = array_fill(0, $array_size, 0);

        $chart_data = Attempt::whereIn('user_id', function ($query) use ($group_id) {
            $query->select('user_id')->from('users_memberships AS um')->where('um.group_id', $group_id);
        })
            ->where('exercise_id', '=', $exercise_id)
            ->select(DB::raw('COUNT(*) as count'),
                DB::raw('truncate(correct_answers_number / (correct_answers_number + wrong_answers_number), 1) * 100  as success_rate'))
            ->groupBy('success_rate')
            ->orderBy('success_rate')
            ->get();

//        $chart_data = DB::table('attempts')
//            ->select(DB::raw('COUNT(*) as count'),
//                DB::raw('truncate(correct_answers_number / (correct_answers_number + wrong_answers_number), 1) * 100  as success_rate'))
//            ->where('user_id', '=', $user_id)
//            ->where('exercise_id', '=', $exercise_id)
//            ->groupBy('success_rate')
//            ->orderBy('success_rate')
//            ->get();



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
