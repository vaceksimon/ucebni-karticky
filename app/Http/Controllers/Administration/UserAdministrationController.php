<?php

namespace App\Http\Controllers\Administration;



use App\Http\Controllers\Controller;

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

    public function index()
    {
        return view('administration.user-administration');
    }
}
