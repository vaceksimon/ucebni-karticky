<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //
    public function index(Request $request) {
        $id = isset($request['id']) ? $request['id'] : Auth::user()->id;
        $user = User::where('id', '=', $id)->get();
        return view('profile', ['user' => $user->first()]);
    }

    public function edit(Request $request) {
        return view('profile', [Auth::user()]);
    }
}
