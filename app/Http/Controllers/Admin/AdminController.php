<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function checkUserOnline()
    {
        return view('admin.onlineuser');
    }
}
