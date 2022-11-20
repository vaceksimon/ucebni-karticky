<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CreateGroupController extends Controller
{
    public function index()
    {
        return view('create-group.create-group');
    }

    public function search(Request $request)
    {
        if ($request->keyword != '')
        {
            $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$request->keyword."%")->get();
        }
        else
        {
            $result = User::all();
        }

        return response()->json(['result' => $result]);


        /*
        $name = $request->name;
        $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$name."%")->get();

        //return dd($result);
        return view('create-group.create-group', compact('result'));
        */




        /*
        $output = "";

        if ($request->ajax())
        {
            $name = $request->name;
            $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$name."%")->get();

            if ($result)
            {
                foreach ($result as $key => $user)
                {
                    $output.='<tr>'.
                        '<td>'.$user->degree_front.'</td>'.
                        '<td>'.$user->first_name.'</td>'.
                        '<td>'.$user->last_name.'</td>'.
                        '<td>'.$user->degree_after.'</td>'.
                        '<td>'.$user->account_type.'</td>'.
                        '</tr>';
                }
            }
        }

        dd($output);

        return Response($output);
        */

        if (request('search'))
        {
            $name = request('search');
            $result = User::where(DB::raw("CONCAT(`first_name`, ' ', `last_name`)"), 'LIKE', "%".$name."%")->get();
        } else {
            $result = User::all();
        }

        return view('create-group.create-group')->with('result', $result);
    }
}
