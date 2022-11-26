<?php

namespace App\Http\Controllers\Statistics;

use App\Http\Controllers\Controller;
use App\Models\Attempt;
use App\Models\Exercise;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupStatisticsController extends Controller
{
    public function index(Request $request) {
        $exercise = Exercise::where('id', $request->exercise_id)
            ->get()
            ->first();

        $group = Group::where('id', $request->group_id)
            ->get()
            ->first();

        $fastestAttempt = Attempt::whereIn('attempts.user_id', function ($query) use ($request) {
            $query->select('user_id')->from('users_memberships AS um')->where('um.group_id', $request->group_id);
        })
            ->where('exercise_id', $request->exercise_id)
            ->orderBy('spend_time')->limit(3)
            ->get();

        $bestAttempt = Attempt::whereIn('attempts.user_id', function ($query) use ($request) {
            $query->select('user_id')->from('users_memberships AS um')->where('um.group_id', $request->group_id);
        })
            ->where('exercise_id', $request->exercise_id)
            ->orderByDesc('correct_answers_number')->limit(3)
            ->get();

        return view('statistics.group-statistics',
            ['exercise' => $exercise, 'group' => $group, 'fastest_attempt' => $fastestAttempt, 'best_attempt' => $bestAttempt]);
    }
}
