<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\Productmenu;
use Illuminate\Support\Str;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

        return view('admin.productmenu', compact('menus'));
    }

    public function productmenuStore(Request $request)
    {

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

    public function transferbankHistory()
    {
        $transferBank = BankTransfer::orderBy('created_at', 'DESC')->paginate(10);
        return view('admin.transferbank', compact('transferBank'));
    }

    public function transferbankSuccess(Request $request)
    {
        $transferBank = BankTransfer::where('mutasi_id', $request->trx_id)->first();
        $transferBank->bkt_trf = $request->bkt_trf;
        $transferBank->status = 'success';
        $transferBank->save();

        return redirect()->back()->with('status', 'Transaksi Sukses.');
    }

    public function transferbankFailed(Request $request)
    {
        DB::transaction(function () use ($request) {

            $transferBank = BankTransfer::where('mutasi_id', $request->trx_id)->first();
            $transferBank->status = 'expired';
            $transferBank->save();

            $user = User::find($transferBank->user_id);

            Mutasi::create([
                'user_id' => $transferBank->user_id,
                'uuid' => $request->trx_id,
                'type' => 'kredit',
                'nominal' => $transferBank->nominal,
                'saldo' => $user->saldo + $transferBank->nominal,
                'note' => 'FAILED TRANSFER BANK'
            ]);

            Mutasi::create([
                'user_id' => $transferBank->user_id,
                'uuid' => 'ADM-' . $request->trx_id,
                'type' => 'kredit',
                'nominal' => $transferBank->biaya,
                'saldo' => $user->saldo + $transferBank->nominal + $transferBank->biaya,
                'note' => 'FAILED ADMIN TRANSFER BANK'
            ]);

            $user->saldo_before_trx = $user->saldo;
            $user->save();
            $user->saldo = $user->saldo + $transferBank->nominal + $transferBank->biaya;
            $user->save();
        });
        return redirect()->back()->with('status', 'Transaksi berhasil dibatalkan');
    }
}
