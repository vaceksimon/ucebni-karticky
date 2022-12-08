<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Groups;

/**
 * Controller for the group-administration view.
 */
class GroupAdministrationController extends Controller
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
     * The index of the group-administration view.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('administration.group-administration');
    }

    /**
     * Function for dynamic searching of the group in the database.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = Group::where('name', 'LIKE', "%".$request->keyword."%")
                ->get();
        }
        else
        {
            $result = Group::all();
        }

        return response()->json(['result' => $result]);
    }

    /**
     * Function for removing the group from the database.
     *
     * @param Request $request
     * @return string
     */
    public function removeGroup(Request $request)
    {
        try {
            DB::table('groups')
                ->where('id', $request->group_id)
                ->delete();
        } catch (Exception $e) {
            return '1';
        }

        return '0';
    }

    /**
     * Function for redirecting from the group administration page
     * to the specific group.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectToGroup(Request $request)
    {
        session(['group_id' => $request->group_id]);

        return redirect('edit-group');
    }
}
