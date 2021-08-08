<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\Payment;
use App\Models\BankSwift;
use App\Models\MutasiBonus;
use App\Models\Productmenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
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

    public function profile()
    {

        return view('member.profile');
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
        $dataPayment = Payment::where('user_id', auth()->user()->id)->orderBy('updated_at', 'desc')->paginate(10);

        return view('product.history', compact('dataPayment'));
    }

    public function showDetails(Request $request)
    {
        $invoice = Payment::where('invoice', $request->invoice)->first();
        $invoice['price'] = explode("|", $invoice['unit_price']);
        $invoice['weight'] = explode("|", $invoice['unit_weight']);
        $invoice['u_item'] = explode("|", $invoice['item']);
        $invoice['qty'] = explode("|", $invoice['unit_qty']);

        return Response::json($invoice);
    }

    public function showClaim()
    {
        $dataUser = User::find(auth()->user()->id)->saldo;

        return view('features.claim', compact('dataUser'));
    }

    public function storeClaim(Request $request)
    {
        if (Hash::check($request->password, auth()->user()->password)) {

            $saldoBonus = auth()->user()->saldo_bonus;
            $saldoBonusNew = $saldoBonus - $request->claim;

            if ($saldoBonusNew <= 0) {
                return redirect()->back()
                    ->with('status', 'Saldo bonus anda tidak mencukupi.');
            }

            DB::transaction(function () use ($request, $saldoBonusNew) {

                $user = User::find(auth()->user()->id);
                $user->saldo_before_trx = $user->saldo;
                $user->save();

                $userSaldoNew = $user->saldo + $request->claim;
                $uuid = "CB-" . uniqid();

                /* Create Mutasi */
                Mutasi::create([
                    "user_id" => auth()->user()->id,
                    "uuid" => $uuid,
                    "type" => "kredit",
                    "nominal" => $request->claim,
                    "saldo" => $userSaldoNew,
                    "note" => "CLAIM BONUS"
                ]);

                /* Create Mutasi Bonus */
                MutasiBonus::create([
                    "user_id" => auth()->user()->id,
                    "uuid" => $uuid,
                    "type" => "debit",
                    "nominal" => $request->claim,
                    "saldo" => $saldoBonusNew,
                    "note" => "SWITCH TO SALDO UTAMA"
                ]);

                /* Set Users */
                $user->saldo = $userSaldoNew;
                $user->saldo_bonus = $saldoBonusNew;
                $user->save();
            });

            return redirect()->back()
                ->with('status', 'Saldo bonus berhasil dipindahkan');
        }
        return redirect()->back()
            ->with('status', 'Salah Password');
    }
}
