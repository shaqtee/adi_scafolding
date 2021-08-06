<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\BankSwift;
use App\Models\Payment;
use App\Models\Productmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Laratrust\Traits\LaratrustUserTrait;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $role = auth()->user()->roles->first->name['name'];
        $icons = Productmenu::orderBy('sort_menu', 'asc')->paginate(10);

        return view('personal.home', compact('role', 'icons'));
    }

    public function transferbank()
    {
        $bank = (BankSwift::all())->toArray();

        return view('features.transferbank');
    }

    public function deposit()
    {

        return view('features.deposit');
    }

    public function mainProdHistory()
    {
        $dataPayment = Payment::where('user_id', auth()->user()->id)->get();

        return view('product.history', compact('dataPayment'));
    }
}
