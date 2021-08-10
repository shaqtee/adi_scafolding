<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use App\Models\User;
use App\Models\Mutasi;
use App\Models\Payment;
use App\Models\BankSwift;
use App\Models\BankTransfer;
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
        $user = User::find(auth()->user()->id);
        if ($user->banks) {
            $bank = BankSwift::where('code', $user->banks['bank'])->first();

            return view('member.profile', compact('user', 'bank'));
        }
        $bank = '';
        return view('member.profile', compact('user'));
    }

    public function profileBank(Request $request)
    {
        DB::transaction(function () use ($request) {

            $request->validate([
                'rek' => 'unique:banks'
            ]);

            $user = User::find(auth()->user()->id);

            if ($user->banks) {
                Bank::where('user_id', auth()->user()->id)->delete();
            }

            Bank::create([
                'nama' => $request->nama,
                'bank' => $request->bankswifts,
                'rek' => $request->rek,
                'user_id' => auth()->user()->id
            ]);
        });

        return redirect('/home/profile')->with('status', 'Data bank berhasil ditambahkan.');
    }

    public function profilePassword(Request $request)
    {
        //dd($request->user());
        $request->validate([
            'new' => 'confirmed'
        ]);

        if (Hash::check($request->old, auth()->user()->password)) {

            $request->user()->fill([
                'password' => Hash::make($request->new)
            ])->save();
        }
        return redirect()->back()->with('password', 'Password berhasil diubah.');
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

    public function dataRekening()
    {
        if (empty(Bank::where('user_id', auth()->user()->id)->first())) {
            $bank = false;
        } else {
            $bank = Bank::where('user_id', auth()->user()->id)->first();
            $bank['swift'] = BankSwift::where('code', $bank->bank)->first();
        }
        return Response::json($bank);
    }

    public function transferbankStore(Request $request)
    {
        $user = User::find(auth()->user()->id);

        if (Hash::check($request->password, $user->password)) {
            DB::transaction(function () use ($request, $user) {
                $bank = BankSwift::where('code', $request->bankswifts)->first();

                $saldoNew = $user->saldo - $request->nominal;
                $biayaAdmin = 3500;

                if ($saldoNew <= (0 + $biayaAdmin)) {
                    return redirect()->back()->with('status', 'Saldo anda tidak mencukupi.');
                } elseif ($request->nominal > 10000000) {
                    return redirect()->back()->with('status', 'Melebihi batas maksimal Transfer Bank.');
                } elseif ($request->nominal < 50000) {
                    return redirect()->back()->with('status', 'Kurang dari batas minimal Transfer Bank.');
                }

                $uuid = 'TB-' . uniqid();

                $user->saldo_before_trx = $user->saldo;
                $user->save();
                $user->saldo = $saldoNew - $biayaAdmin;
                $user->save();

                Mutasi::create([
                    'user_id' => auth()->user()->id,
                    'uuid' => $uuid,
                    'type' => 'debit',
                    'nominal' => $request->nominal,
                    'saldo' => $saldoNew,
                    'note' => 'TRANSFER BANK'
                ]);

                Mutasi::create([
                    'user_id' => auth()->user()->id,
                    'uuid' => 'ADM-' . $uuid,
                    'type' => 'debit',
                    'nominal' => $biayaAdmin,
                    'saldo' => $saldoNew - $biayaAdmin,
                    'note' => 'TRANSFER BANK BIAYA ADMIN'
                ]);


                BankTransfer::create([
                    'user_name' => $user->name,
                    'mutasi_id' => $uuid,
                    'bank' => $bank->name,
                    'rek' => $request->rek,
                    'nama' => $request->nama,
                    'nominal' => $request->nominal,
                    'biaya' => $biayaAdmin,
                    'saldo_before_trx' => $user->saldo_before_trx,
                    'saldo_after_trx' => $user->saldo,
                    'user_id' => auth()->user()->id
                ]);
                return redirect()->back()->with('berhasil', 'Permintaan Transfer Bank dalam proses.');
            });
        } else {
            return redirect()->back()->with('status', 'Password yang anda masukkan salah.');
        };
        return redirect()->back();
    }

    public function transferbankHistory()
    {
        $transferBank = BankTransfer::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(10);

        return view('member.transferbankhistory', compact('transferBank'));
    }

    public function sendForm()
    {

        return view('member.sendform');
    }

    public function searchPhone(Request $request)
    {
        $nama = User::select('name')->where('phone', $request->phone)->first()['name'] ?? '<span class="text-danger">Nomor Handphoe tujuan tidak ditemukan, periksa kembali nomor handphone tujuan anda.</span>';
        return Response::json($nama);
    }

    public function sendSaldo(Request $request)
    {
        //dd($request);
        if (User::where('phone', $request->phone)->first()) {
            $penerima = User::where('phone', $request->phone)->first();
        } else {
            return redirect()->back()->with('status', 'Data penerima tidak ditemukan.');
        }
        $data = User::find(auth()->user()->id);

        if (Hash::check($request->new, $data->password)) {
            $saldoNew = $data->saldo - $request->nominal;

            if ($saldoNew <= 0) {
                return redirect()->back()->with('status', 'Saldo anda tidak mencukupi');
            }

            $data->saldo_before_trx = $data->saldo;
            $data->save();
            $data->saldo = $saldoNew;
            $data->save();

            /* pengirim */
            $uuid = "SS-" . uniqid();
            Mutasi::create([
                'user_id' => auth()->user()->id,
                'uuid' => $uuid,
                'type' => 'debit',
                'nominal' => $request->nominal,
                'saldo' => $saldoNew,
                'note' => 'SEND SALDO TO ' . $penerima->name
            ]);

            /* penerima */
            Mutasi::create([
                'user_id' => $penerima->id,
                'uuid' => $uuid,
                'type' => 'kredit',
                'nominal' => $request->nominal,
                'saldo' => $penerima->saldo + $request->nominal,
                'note' => 'RECEIVE SALDO FROM ' . auth()->user()->name
            ]);

            $penerima->saldo_before_trx = $penerima->saldo;
            $penerima->save();
            $penerima->saldo = $penerima->saldo + $request->nominal;
            $penerima->save();

            return redirect()->back()->with('berhasil', 'Saldo berhasil dikirim.');
        };
        return redirect()->back()->with('status', 'Salah Password');
    }
}
