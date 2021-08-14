<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\User;
use Midtrans\Config;
use App\Models\Mutasi;

use App\Models\Deposit;
use App\Models\Payment;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;

class PaymentController extends Controller
{

    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }

    public function index()
    {
        $payments = Payment::orderBy('id', 'desc')->paginate(8);
        return view('checkout', compact('payments'));
    }

    public function create()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $setSaldoUser = User::find(intval($request->user_id));
            $getUserSaldo = $setSaldoUser->saldo;
            $nominal = floatval($request->amount);
            $userSaldoNew = $getUserSaldo - $nominal;

            if ($userSaldoNew <= 0) {
                $this->response = false;
            } else {
                Payment::create([
                    'invoice' => $request->invoice,
                    'item' => $request->item,
                    'unit_qty' => $request->unit_qty,
                    'unit_weight' => $request->unit_weight,
                    'unit_price' => $request->unit_price,
                    'unit_disc' => $request->unit_disc,
                    'unit_disc_price' => $request->unit_disc_price,
                    'unit_price_before_disc' => $request->unit_price_before_disc,
                    'courier_service' => $request->courier . "|" . $request->guest_type,
                    'subtotal' => $request->dbSubtotal,
                    'ongkir' => $request->dbOngkir,
                    'door' => $request->door,
                    'user_id' => $request->user_id,
                    'phone' => $request->phone,
                    'address' => $request->alamat,
                    'kodepos' => $request->kodepos,
                    'propinsi' => $request->propinsi,
                    'kota' => $request->kota,
                    'kota' => $request->kota,
                    'guest_name' => $request->guest_name,
                    'guest_email' => $request->guest_email,
                    'amount' => floatval($request->amount),
                    'note' => $request->note,
                ]);

                /* debit */
                $setSaldoUser->saldo_before_trx = $getUserSaldo;
                $setSaldoUser->saldo = $userSaldoNew;
                $setSaldoUser->save();

                Mutasi::create([
                    'user_id' => $setSaldoUser->id,
                    'uuid' => $request->invoice,
                    'type' => 'debit',
                    'nominal' => $nominal,
                    'saldo' => $userSaldoNew,
                    'note' => 'PENJUALAN UTAMA'
                ]);

                Session::put([
                    'myCart' => [],
                    'checkout' => [],
                    'ongkir' => [],
                    'select' => [],
                ]);

                session()->flash('status', 'Pesanan anda diproses.');
                $this->response = 200;
            }
        });

        return Response::json($this->response);
    }

    public function notification(Request $request)
    {
        $notif = new Notification();
        DB::transaction(function () use ($notif) {

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $orderId = $notif->order_id;
            $fraud = $notif->fraud_status;
            $donation = Payment::findOrFail($orderId);

            if ($transaction == 'capture') {
                if ($type == 'credit_card') {

                    if ($fraud == 'challenge') {
                        $donation->setStatusPending();
                    } else {
                        $donation->setStatusSuccess();
                    }
                }
            } elseif ($transaction == 'settlement') {

                $donation->setStatusSuccess();
            } elseif ($transaction == 'pending') {

                $donation->setStatusPending();
            } elseif ($transaction == 'deny') {

                $donation->setStatusFailed();
            } elseif ($transaction == 'expire') {

                $donation->setStatusExpired();
            } elseif ($transaction == 'cancel') {

                $donation->setStatusFailed();
            }
        });

        return;
    }

    public function deposit(Request $request)
    {
        DB::transaction(function () use ($request) {
            $payment = Deposit::create([
                'deposit' => $request->deposit,
                'user_id' => intval($request->user_id),
                'amount' => floatval($request->amount),
                'note' => $request->note
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'      => $payment->id,
                    'gross_amount'  => $payment->amount,
                ],
                'customer_details' => [
                    'first_name'    => $request->guest_name,
                    'email'         => $request->guest_email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $payment->deposit,
                        'price'    => $payment->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $payment->deposit))
                    ]
                ]
            ];
            $snapToken = Snap::getSnapToken($payload);
            $payment->snap_token = $snapToken;
            $payment->save();

            $this->response['snap_token'] = $snapToken;
        });

        return Response::json($this->response);
    }
}
