<?php

namespace App\Http\Controllers\Member;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles->first->name['name'];
        return view('member.home', compact('role'));
    }
}
