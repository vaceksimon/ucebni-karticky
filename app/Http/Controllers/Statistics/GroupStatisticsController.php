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
