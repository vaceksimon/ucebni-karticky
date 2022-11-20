<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function show()
    {
        return view('groups.mygroups')
            ->with('teacherGroups', $this->getTeacherGroups())
            ->with('studentGroups', $this->getStudentGroups());
    }

    public function getTeacherGroups()
    {
        return Group::where('owner', '=', Auth::user()->id)
            ->where('type', '=', Group::TEACHERS_GROUP)
            ->get();
    }

    public function getStudentGroups()
    {
        return Group::where('owner', '=', Auth::user()->id)
            ->where('type', '=', Group::STUDENTS_GROUP)
            ->get();
    }
}
