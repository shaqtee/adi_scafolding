<?php

namespace App\Http\Controllers\Member;

use App\Models\Role;
use App\Models\Productmenu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MemberController extends Controller
{
    public function index()
    {
        $role = auth()->user()->roles->first->name['name'];
        $icons = Productmenu::orderBy('sort_menu', 'asc')->paginate(10);
        return view('member.home', compact('role', 'icons'));
    }
}
