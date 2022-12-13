<?php
/***********************
 * Author: Tomas Bartu *
 * Login: xbartu11     *
 ***********************/
namespace App\Http\Controllers\Flashcards;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class FlashcardController extends Controller
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
     * Function which return view of flashcards if user has access to it else return error page
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Request $request)
    {
        if ($this->hasAccess($request->id))
            return view('flashcards.flashcard', ['id' => $request->id]);
        else
            return view('flashcards.flashcard-invalid');
    }

    /**
     * Return all flashcards in exercises
     *
     * @param Request $request
     * @return \Illuminate\Support\Collection
     */
    public function getCards(Request $request)
    {
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }

    /**
     * @param Request $request
     * @return string
     */
    public function storeSession(Request $request)
    {
        Session::put('correct', $request->correct);
        Session::put('counter', $request->counter);
        Session::put('wrong', $request->wrong);
        Session::put('sec', $request->sec);
        Session::put('id', $request->id);
        return "1";
    }

    public function getSession(Request $request)
    {
        $res = array();
        if ((Session::exists('correct') && Session::exists('counter') && Session::exists('wrong'))) {
            if (Session::get('id') == $request->id) {
                $res[0]['correct'] = Session::get('correct');
                $res[0]['counter'] = Session::get('counter');
                $res[0]['wrong'] = Session::get('wrong');
                $res[0]['sec'] = Session::get('sec');
            } else {
                Session::put('correct', 0);
                Session::put('counter', 0);
                Session::put('wrong', 0);
                Session::put('sec', 0);
                Session::put('id', $request->id);
            }
        } else {
            Session::put('correct', 0);
            Session::put('counter', 0);
            Session::put('wrong', 0);
            Session::put('sec', 0);
            Session::put('sec', $request->id);
        }
        return response()->json(['result' => json_encode($res)]);
    }

    /**
     * Function to check if user has access to flashcards set
     *
     * @param $exercise_id
     * @return bool True if user has access else return false
     */
    public
    static function hasAccess($exercise_id)
    {
        if (Auth::user()->account_type === User::ROLE_STUDENT)
            return !(self::studentAccess($exercise_id) === 0);
        elseif (Auth::user()->account_type === User::ROLE_TEACHER)
            return !(self::teacherAccess($exercise_id) === 0 && self::teacherAccessByShare($exercise_id) === 0);
        else
            return false;
    }

    /**
     * @param $exercise_id
     * @return int How many exercises has teacher access
     */
    private
    static function teacherAccess($exercise_id)
    {
        return DB::table('exercises')
            ->select('*')
            ->where('id', '=', $exercise_id)
            ->where('author', '=', Auth::user()->id)
            ->get()->count();
    }

    /**
     * @param $exercise_id
     * @return int How many shared exercises has teacher access
     */
    private
    static function teacherAccessByShare($exercise_id)
    {
        return DB::table('exercises AS ex')
            ->select(DB::raw('ex.id, ex.name AS e_name, ex.topic, gr.name AS g_name, ex.description'))
            ->addSelect(DB::raw('(SELECT COUNT(*)
                        FROM flashcards fs
                        WHERE fs.exercise_id = ex.id) AS pocet'))
            ->join('shared_exercises AS se', 'se.exercise_id', '=', 'ex.id')
            ->join('groups AS gr', 'se.group_id', '=', 'gr.id')
            ->join('users_memberships AS um', 'um.group_id', '=', 'gr.id')
            ->join('users AS us', 'um.user_id', '=', 'us.id')
            ->where('us.account_type', '=', User::ROLE_TEACHER)
            ->where('us.id', '=', Auth::user()->id)
            ->where('ex.id', '=', $exercise_id)
            ->get()
            ->count();
    }

    /**
     * @param $exercise_id
     * @return int How many exercises has student access
     */
    private
    static function studentAccess($exercise_id)
    {
        return DB::table('users AS us')
            ->select('*')
            ->join('users_memberships AS um', 'us.id', '=', 'um.user_id')
            ->join('groups AS gr', 'gr.id', '=', 'um.group_id')
            ->join('assigned_exercises AS ae', 'gr.id', '=', 'ae.group_id')
            ->join('exercises AS ex', 'ex.id', '=', 'ae.exercise_id')
            ->where('gr.type', '=', 'students')
            ->where('us.id', '=', Auth::user()->id)
            ->where('ex.id', '=', $exercise_id)
            ->get()
            ->count();
    }
}
