<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\lessThanOrEqual;

class ProfileController extends Controller
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
     * Returns user information
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        if (!isset($request['id'])) // if no user_id is specified in parameters choose user currently logged in
            $id = Auth::id();
        elseif (User::where('id', $request['id'])->doesntExist()) // user_id doesn't exist -> error 404
            return view('errors.404');
        else // user_id is specified in route parameters
            $id = $request['id'];

        $user = User::where('id', $id)->get();

        if (Auth::user()->account_type == 'admin') // account_type admin can only edit profiles, not display them
            return view('profile.edit', ['user' => $user->first()]);

        if(!isset($request['id']) || Auth::id() == $request['id'])
            return view('profile.show', ['user' => $user->first()]);
        else
            return view('profile.show', ['user' => $user->first(), 'groups' => $this->getCommonGroups($request['id'])]);
    }

    /**
     * Retrieves all groups this user and the authenticated user have in common (are both somehow related to).
     *
     * @param String $user_id Giver user's id
     * @return \Illuminate\Support\Collection
     */
    private function getCommonGroups(String $user_id): \Illuminate\Support\Collection
    {
        $account_type = User::where('id', $user_id)->get()->first()['account_type'];
        if(Auth::user()->account_type == 'teacher' && $account_type == 'student') {
            $groups = DB::table('groups AS g')
                ->select('g.*')
                ->join('users_memberships AS um', 'g.id', 'um.group_id')
                ->where( 'g.owner', Auth::id())
                ->where( 'um.user_id', $user_id)
                ->orderBy('g.name')
                ->get();
        }
        else if(Auth::user()->account_type == 'teacher') {
            $groups = DB::table('groups AS g')
                ->select('g.*')
                ->join('users_memberships AS um1', 'g.id', 'um1.group_id')
                ->where( 'um1.user_id', Auth::id())
                ->join('users_memberships AS um2', 'g.id', 'um2.group_id')
                ->where( 'um2.user_id', $user_id)
                ->orderBy('g.name')
                ->get();
        }
        else if (Auth::user()->account_type == 'student' && $account_type == 'teacher') {
            $groups = DB::table('groups AS g')
                ->select('g.*')
                ->join('users_memberships AS um', 'g.id', 'um.group_id')
                ->where( 'g.owner', $user_id)
                ->where( 'um.user_id', Auth::id())
                ->orderBy('g.name')
                ->get();
        }
        else {
            $groups = DB::table('groups AS g')
                ->select('g.*')
                ->join('users_memberships AS um1', 'g.id', 'um1.group_id')
                ->where('um1.user_id', Auth::id())
                ->join('users_memberships AS um2', 'g.id', 'um2.group_id')
                ->where('um2.user_id', $user_id)
                ->orderBy('g.name')
                ->get();
        }

        return $groups;
    }

    /**
     * Returns redirection to edit profile page for currently logged in user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    /**
     * Saves user information to the database.
     *
     * This function is shared for all account types.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user()->account_type != 'admin')
        {
            if (!isset($request->first_name) || !isset($request->last_name) || !isset($request->email)) // server-side check for mandatory fields
                return redirect(route('profile.edit', ['errorValidation' => true]));

            // save mandatory fields
            User::where('id', Auth::id())->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email]);

            if(isset($request->password)) // save password field only if it was entered in the form
                User::where('id', Auth::id())->update(['password' => bcrypt($request->password)]);

            if (isset($request->image)) { // save image only if it was entered in the form
                $image_uploader = new ImageUploadController();
                $image_name = $image_uploader->imageUploadPost($request);

                $image_name = "images/" . $image_name;

                User::where('id', Auth::id())->update(['photo' => $image_name]);
            }

            if (Auth::user()['account_type'] == 'teacher') // teacher can enter more fields to his account
                User::where('id', Auth::id())->update(['degree_front' => $request->degree_front, 'degree_after' => $request->degree_after, 'school' => $request->school]);

            return redirect(route('profile'));
        }
        else // admin is editing the profile
        {
            if (!isset($request->first_name) || !isset($request->last_name) || !isset($request->email)) // server-side check for mandatory fields
            return redirect(route('profile', ['id' => $request->user_id, 'errorValidation' => true]));

            // save mandatory fields
            User::where('id', $request->user_id)->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email]);

            if(isset($request->password)) // save password field only if it was entered in the form
                User::where('id', $request->user_id)->update(['password' => bcrypt($request->password)]);

            if (isset($request->image)) { // save image only if it was entered in the form
                $image_uploader = new ImageUploadController();
                $image_name = $image_uploader->imageUploadPost($request);

                $image_name = "images/" . $image_name;

                User::where('id', $request->user_id)->update(['photo' => $image_name]);
            }

            if(isset($request->degree_front) || isset($request->degree_after) || isset($request->school)) // teacher can enter more fields to his account
                User::where('id', $request->user_id)->update(['degree_front' => $request->degree_front, 'degree_after' => $request->degree_after, 'school' => $request->school]);

            return redirect(route('profile', ['id' => $request->user_id]));
        }
    }

    /**
     * Deletes currently logged in user from the database and redirects to welcome page.
     *
     * This function is for users of type teacher or admin. Admin can not delete their own profile.
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function delete(Request $request)
    {
        User::where('id', $request->user_id)
            ->delete();

        return redirect(route('welcome'));
    }

}
