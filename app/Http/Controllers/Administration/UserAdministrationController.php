<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserAdministrationController extends Controller
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
         return view('administration.user-administration');

    }

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
            $result = User::where( 'account_type', '<>', 'admin')->get();
        }

        return response()->json(['result' => $result]);
    }

    public function removeUser(Request $request)
    {
        DB::table('users')
            ->where('id', $request->user_id)
            ->delete();

        return view('administration.user-administration');
    }
}
