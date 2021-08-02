<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $role = 'Agent';
        return view('member.home', compact('role'));
    }
}
