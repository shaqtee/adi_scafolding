<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Mutasi;
use App\Models\Payment;
use App\Models\Pengiriman;
use App\Models\MutasiBonus;
use App\Models\Productmenu;
use Illuminate\Support\Str;
use App\Models\BankTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Response;
use Khill\Lavacharts\Lavacharts;
use Lava;

class AdminController extends Controller
{
    public function index()
    {
        /* Sort name => qty */
        function array_flatten($array)
        {
            if (!is_array($array)) {
                return FALSE;
            }
            $result = array();
            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $result = array_merge($result, array_flatten($value));
                } else {
                    $result[$key] = $value;
                }
            }
            return $result;
        }

        $payments = (Payment::where('status', 'process')->orderBy('updated_at', 'DESC')->get())->toArray();

        foreach ($payments as $payment) {
            $item['nama'][] = explode('|', $payment['item']);
            $item['unit'][] = explode('|', $payment['unit_qty']);
        }

        $nama = array_flatten($item['nama']);
        $unit = array_flatten($item['unit']);

        foreach ($nama as $k => $v) {
            $produk[] = [$v => $unit[$k]];
        }

        foreach ($produk as $key => $prod) {
            foreach ($prod as $k => $p) {
                if (!isset($produk[$k])) {
                    $produk[$k] = 0;
                }
                $produk[$k] += $p;
            }
        }

        foreach ($produk as $key => $prod) {
            if (is_integer($key)) {
                continue;
            }
            $result[] = [$key => $prod];
        }
        /* end Sort name => qty */

        /* ====================E-COMMERCE=================== */

        $reasons = Lava::DataTable();

        $reasons->addStringColumn('Reasons')
            ->addNumberColumn('Percent');

        foreach ($result as $key => $res) {
            foreach ($res as $k => $r) {
                $reasons->addRow([$k, $r]);
            }
        }

        Lava::PieChart('reasons', $reasons, [
            'title'  => 'Produk Utama',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);
        /* ====================End E-COMMERCE=================== */

        /* ====================PPOB=================== */

        $ppob = Lava::DataTable();

        $ppob->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['OVO', 15])
            ->addRow(['Telkomsel', 10])
            ->addRow(['Dana', 50])
            ->addRow(['XL Pulsa', 25]);

        Lava::PieChart('ppob', $ppob, [
            'title'  => 'Produk PPOB',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);
        /* ====================End PPOB=================== */



        $allUserSaldo = User::sum('saldo');
        $allUserBonus = User::sum('saldo_bonus');



        return view('admin.home', compact('allUserSaldo', 'allUserBonus', 'reasons', 'ppob'));
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

    public function productmenuUpdate(Request $request, $key)
    {
        Productmenu::where('sort_menu', $key)->update([
            'menu_name' => $request->menu,
            'sort_menu' => $request->sort_id
        ]);

        return redirect()->back()->with('status', 'updated!');
    }

    public function productmenuDelete($key)
    {
        $id = (Productmenu::select('id')->where('sort_menu', $key)->first())->id;
        Productmenu::find($id)->delete();

        return redirect()->back()->with('status', 'deleted!');
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

    public function historyMainProd()
    {
        $dataPayment = Payment::orderBy('updated_at', 'desc')->paginate(10);

        return view('admin.historymainprod', compact('dataPayment'));
    }

    public function showDetails(Request $request)
    {
        $invoice = Payment::where('invoice', $request->invoice)->first();
        $invoice['price'] = explode("|", $invoice['unit_price']);
        $invoice['weight'] = explode("|", $invoice['unit_weight']);
        $invoice['u_item'] = explode("|", $invoice['item']);
        $invoice['qty'] = explode("|", $invoice['unit_qty']);

        $invoice['disc'] = explode("|", $invoice['unit_disc']);
        $invoice['disc_price'] = explode("|", $invoice['unit_disc_price']);
        $invoice['price_before_disc'] = explode("|", $invoice['unit_price_before_disc']);

        return Response::json($invoice);
    }

    public function successMainProd(Request $request)
    {
        Payment::where('invoice', $request->invoiceUuid)->update([
            'status' => 'resi: ' . $request->proof
        ]);

        return redirect()->back()->with('status', 'Status has been changed to "success"');
    }

    public function refundMainProd($inv)
    {
        $data = Mutasi::where('uuid', $inv)->first();
        $check = Payment::select('status')->where('invoice', $inv)->first();

        if ($check->status === 'process') {
            $user = User::find($data->user_id);
            $user->saldo_before_trx = $user->saldo;
            $user->save();
            $user->saldo += $data->nominal;
            $user->save();

            Payment::where('invoice', $inv)->update([
                'status' => 'refund'
            ]);


            Mutasi::create([
                'user_id' => $data->user_id,
                'uuid' => $inv,
                'type' => 'kredit',
                'nominal' => $data->nominal,
                'saldo' => $user->saldo,
                'note' => 'REFUND PENJUALAN UTAMA'
            ]);

            return redirect()->back()->with('status', 'refund has done!');
        } else {
            return redirect()->back()->with('failed', 'double refund is rejected!');
        }
    }

    public function dataPengiriman()
    {
        $pengiriman = (Pengiriman::orderBy('created_at', 'DESC')->get())->toArray();
        return view('admin.datapengiriman', compact('pengiriman'));
    }

    public function dataBonus()
    {
        $bonus = (MutasiBonus::orderBy('created_at', 'DESC')->get())->toArray();
        return view('admin.databonus', compact('bonus'));
    }
}
