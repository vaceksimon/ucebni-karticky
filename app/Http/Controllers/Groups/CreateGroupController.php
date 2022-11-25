<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateGroupController extends Controller
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
    
    public function index()
    {
        return view('groups.create-group');
    }
/*
    public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")
                ->where( 'account_type', '<>', 'admin')
                ->get();
        }
        else
        {
            $result = User::where('account_type', '<>', 'admin')->get();
        }

        return response()->json(['result' => $result]);
    }
*/
    public function store(Request $request)
    {
        $user = auth()->user();

        $group = $user->groupsOwnerships()->create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'visibility' => $request->visibility,
        ]);

        $group->save();

        return redirect('mygroups')->with('status', 'Post Form Data Has Been inserted');
    }
}
