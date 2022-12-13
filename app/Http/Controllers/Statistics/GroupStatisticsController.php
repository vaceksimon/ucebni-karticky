<?php

/**********************************************************/
/*                                                        */
/* File: GroupStatisticsController.php                    */
/* Author: Simon Vacek <xvacek10@stud.fit.vutbr.cz>       */
/* Project: Project for the course ITU                    */
/* Description: Controller for the group-statistics view. */
/*                                                        */
/**********************************************************/

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Exercise;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Controller for the group-statistics view.
 */
class GroupStatisticsController extends Controller
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
     * Returns group statistics view with data regarding exercise, group, fastest and best attempt and chart data.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        $exercise = DB::table('exercises AS ex')
            ->where('ex.id', $request->exercise_id)
            ->Select(DB::raw('*, (SELECT COUNT(*) FROM flashcards AS fc WHERE ex.id = fc.exercise_id) AS count'))
            ->get()
            ->first();

        $group = Group::where('id', $request->group_id)
            ->get()
            ->first();

        $isAssigned = DB::table('assigned_exercises')
            ->where('group_id', $request->group_id)
            ->where('exercise_id', $request->exercise_id)
            ->get()
            ->first();


        if($exercise == null || $group == null || Auth::id() != $group->owner || $isAssigned == null) {
            return view('errors.403');
        }

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
                'members' => $this->getMembers($request->group_id),
                'chart_data' => $this->chartData($request->group_id, $request->exercise_id)]);
    }


    /**
     * Returns all students which are members of a group with $group_id.
     *
     * @param $group_id
     * @return mixed
     */
    private function getMembers($group_id)
    {
        return User::whereIn('users.id', function ($query) use ($group_id) {
            $query->select('um.user_id')->from('users_memberships AS um')->where('um.group_id', $group_id);
        })
            ->get();
    }

    /**
     * Function for searching the students which are members of the group for which the statistics are shown.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchStudent(Request $request)
    {
        $account_type = $request->user_type;

        $owner_id = DB::table('groups')->where('id', '=', $request->group_id)->value('owner');

        if ($request->keyword != '')
        {
            $result = User::whereIn('users.id', function ($query) use ($request, $owner_id) {
                $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id)->where('user_id', '<>', $owner_id);
            })->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '=', $account_type)
                ->get();
        }
        else
        {
            $result = User::whereIn('users.id', function ($query) use ($request, $owner_id) {
                $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id)->where('user_id', '<>', $owner_id);
            })->where( 'account_type', '=', $account_type)
                ->get();
        }

        return response()->json(['result' => $result]);
    }

    /**
     * Retrieves and transforms data of all exercise attempts which are relevant to a chart.
     *
     * @param $group_id
     * @param $exercise_id
     * @return array
     */
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

        foreach ($chart_data as $data) {
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
