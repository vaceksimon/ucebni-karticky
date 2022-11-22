<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    //
    public function index(Request $request)
    {
        if (!isset($request['id']))
            $id = Auth::id();
        elseif (User::where('id', $request['id'])->doesntExist())
            return redirect(route('profile'));
        else
            $id = $request['id'];

        $user = User::where('id', $id)->get();
        return view('profile.show', ['user' => $user->first()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function store(Request $request)
    {
        User::where('id', Auth::id())->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'password' => bcrypt($request->password)]);

        if(isset($request->photo))
            User::where('id', Auth::id())->update(['photo' => $request->photo]);

        if(Auth::user()['account_type'] == 'teacher')
            User::where('id', Auth::id())->update(['degree_front' => $request->degree_front, 'degree_after' => $request->degree_after, 'school' => $request->school]);

        return redirect(route('profile'));
    }
}
