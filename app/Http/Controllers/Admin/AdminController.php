<?php

namespace App\Http\Controllers\Admin;

use App\Models\Productmenu;
use Illuminate\Support\Str;
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

    public function productmenu()
    {
        $menus = Productmenu::select(['menu_name', 'sort_menu'])->orderBy('sort_menu', 'desc')->paginate(5);
        //dd($menus);
        return view('admin.productmenu', compact('menus'));
    }

    public function productmenuStore(Request $request)
    {
        //dd($request);
        Productmenu::updateOrCreate(
            [
                'menu_name' => $request->menu_name
            ],
            [
                'menu_name' => $request->menu_name,
                'slug' => Str::slug($request->menu_name),
                'icon' => $request->icon,
                'jenis' => $request->jenis,
                'sort_menu' => $request->sort_menu
            ]
        );
        return redirect('admin/productmenu')->with('status', 'Menu berhasil ditambahkan.');
    }
}
