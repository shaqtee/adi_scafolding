<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Payment;
use Midtrans\Notification;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $payment = Payment::create([
                'guest_name' => $request->guest_name,
                'guest_email' => $request->guest_email,
                'guest_type' => $request->guest_type,
                'amount' => floatval($request->amount),
                'note' => $request->note,
            ]);

            $payload = [
                'transaction_details' => [
                    'order_id'      => $payment->id,
                    'gross_amount'  => $payment->amount,
                ],
                'customer_details' => [
                    'first_name'    => $payment->guest_name,
                    'email'         => $payment->guest_email,
                    // 'phone'         => '08888888888',
                    // 'address'       => '',
                ],
                'item_details' => [
                    [
                        'id'       => $payment->guest_type,
                        'price'    => $payment->amount,
                        'quantity' => 1,
                        'name'     => ucwords(str_replace('_', ' ', $payment->guest_type))
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
}
