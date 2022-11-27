<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    //
    public function index(Request $request)
    {
        if (!isset($request['id']))
            $id = Auth::id();
        elseif (User::where('id', $request['id'])->doesntExist())
            return view('errors.404');
        else
            $id = $request['id'];

        $user = User::where('id', $id)->get();

        if (Auth::user()->account_type == 'admin')
            return view('profile.edit', ['user' => $user->first()]);
        else
            return view('profile.show', ['user' => $user->first()]);
    }

    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function store(Request $request)
    {
        if (Auth::user()->account_type != 'admin')
        {
            if (!isset($request->first_name) || !isset($request->last_name) || !isset($request->email))
                return redirect(route('profile.edit', ['errorValidation' => true]));

            User::where('id', Auth::id())->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email]);

            if(isset($request->password))
                User::where('id', Auth::id())->update(['password' => bcrypt($request->password)]);

            if (isset($request->image)) {
                $image_uploader = new ImageUploadController();
                $image_name = $image_uploader->imageUploadPost($request);

                $image_name = "images/" . $image_name;

                User::where('id', Auth::id())->update(['photo' => $image_name]);
            }

            if (Auth::user()['account_type'] == 'teacher')
                User::where('id', Auth::id())->update(['degree_front' => $request->degree_front, 'degree_after' => $request->degree_after, 'school' => $request->school]);

            return redirect(route('profile'));
        }
        else
        {
            if (!isset($request->first_name) || !isset($request->last_name) || !isset($request->email))
            return redirect(route('profile', ['id' => $request->user_id, 'errorValidation' => true]));

            User::where('id', $request->user_id)->update(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email]);

            if(isset($request->password))
                User::where('id', $request->user_id)->update(['password' => bcrypt($request->password)]);

            if (isset($request->image)) {
                $image_uploader = new ImageUploadController();
                $image_name = $image_uploader->imageUploadPost($request);

                $image_name = "images/" . $image_name;

                User::where('id', $request->user_id)->update(['photo' => $image_name]);
            }

            if(isset($request->degree_front) || isset($request->degree_after) || isset($request->school))
                User::where('id', $request->user_id)->update(['degree_front' => $request->degree_front, 'degree_after' => $request->degree_after, 'school' => $request->school]);

            return redirect(route('profile', ['id' => $request->user_id]));
        }
    }

    public function delete(Request $request)
    {
        User::where('id', $request->user_id)
            ->delete();

        return redirect(route('welcome'));
    }

}
