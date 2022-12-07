<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ImageUploadController;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

/**
 * Function for the edit-group view.
 */
class EditGroupController extends Controller
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
     * The index of the edit-group view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        if (Session::has('group_id'))
        {
            $group_id = Session::get('group_id');
            $group = Group::where('id', '=', $group_id)->get();

            $members = User::leftJoin('users_memberships', function($join) {
                $join->on('users.id', '=', 'users_memberships.user_id');
            })->whereNotIn('user_id', function ($query) use ($group_id) {
                $query->select('owner')->from('groups')->where('groups.id', '=', $group_id);
            })->where('users_memberships.group_id', '=', $group_id)->get();

            return view('groups.edit-group')
                ->with('group', $group)
                ->with('members', $members);
        }

        return view('home');
    }

    /**
     * Function for storing the new group in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        $account_type = rtrim($request->group_type, "s");

        if ($request->keyword != '')
        {
            $result = User::whereNotIn('users.id', function ($query) use ($request) {
                    $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
                })->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '=', $account_type)
                ->get();
        }
        else
        {
            $result = User::whereNotIn('users.id', function ($query) use ($request) {
                    $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
                })->where( 'account_type', '=', $account_type)->get();
        }

        return response()->json(['result' => $result]);
    }

    public function searchMember(Request $request)
    {
        $account_type = rtrim($request->group_type, "s");

        if ($request->keyword != '')
        {
            $result = User::whereIn('users.id', function ($query) use ($request) {
                $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
            })->where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '=', $account_type)
                ->get();
        }
        else
        {
            $result = User::whereIn('users.id', function ($query) use ($request) {
                $query->select('user_id')->from('users_memberships')->where('group_id', '=', $request->group_id);
            })->where( 'account_type', '=', $account_type)->get();
        }

        return response()->json(['result' => $result]);
    }

    /**
     * Function for storing the new group in the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(Request $request)
    {
        if ($request->image != null)
        {
            $image_uploader = new ImageUploadController();
            $image_name = $image_uploader->imageUploadPost($request);

            $image_name = "images/" . $image_name;

            Group::where('id', '=', $request->group_id)->update(['name' => $request->name, 'description' => $request->description, 'photo' => $image_name]);
        }
        else{
            Group::where('id', '=', $request->group_id)->update(['name' => $request->name, 'description' => $request->description]);
        }

        return $this->index();
    }

    /**
     * Function for removing the member from the group.
     *
     * @param Request $request
     */
    public function removeMember(Request $request)
    {
        $member_id = $request->member_id;
        $group_id = $request->group_id;

        // Then remove user from the group.
        DB::table('users_memberships')
            ->where('user_id', $member_id)
            ->where('group_id', $group_id)
            ->delete();
    }

    /**
     * Function for adding member to the group.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addMember(Request $request)
    {
        $user_id = $request->new_user_id;
        $group_id = $request->new_user_group_id;

        DB::insert('insert into users_memberships (user_id, group_id) values (?, ?)', [$user_id, $group_id]);

        return redirect('edit-group');
    }

    /**
     * Function for removing the whole group from the database.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function deleteGroup(Request $request)
    {
        DB::table('groups')
            ->where('id', $request->group_id)
            ->delete();

        if (Auth::user()->account_type != 'admin')
        {
            $groupController = new GroupController();
            return $groupController->show();
        }

        return view('administration.group-administration');
    }
}
