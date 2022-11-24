<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\TextUI\XmlConfiguration\Groups;

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

    public function index(Request $request)
    {
        return view('administration.group-administration');
    }

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

    public function removeGroup(Request $request)
    {
        // TODO
        /*
        DB::table('users')
            ->where('id', $request->user_id)
            ->delete();
        */
        return view('administration.group-administration');
    }

    public function redirectToGroup(Request $request)
    {
        dd($request);
        //session(['group_id' => $request->group_id]);

        return redirect('edit-group');
    }
}
