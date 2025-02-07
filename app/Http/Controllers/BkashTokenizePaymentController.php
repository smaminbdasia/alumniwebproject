<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Karim007\LaravelBkashTokenize\Facade\BkashPaymentTokenize;
use Karim007\LaravelBkashTokenize\Facade\BkashRefundTokenize;

use Illuminate\Support\Facades\Log;
use App\Models\Event;
use App\Models\EventReg;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BkashTokenizePaymentController extends Controller
{
    public function index()
    {
        return view('bkashT::bkash-payment');
    }
    public function createPayment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
            'event_id' => 'required|exists:events,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Redirect with errors and old input
        }

        $inv = uniqid();
        $request['intent'] = 'sale';
        $request['mode'] = '0011'; //0011 for checkout
        $request['payerReference'] = $inv;
        $request['currency'] = 'BDT';
        $request['amount'] = $request->amount;
        $request['merchantInvoiceNumber'] = $inv;
        $request['callbackURL'] = config("bkash.callbackURL") . '?event_id=' . $request->event_id; // ✅ Pass event ID


        $request_data_json = json_encode($request->all());
        $response = BkashPaymentTokenize::cPayment($request_data_json);

        Log::info('Create Payment Response:', ['response' => $response]);


        //$response =  BkashPaymentTokenize::cPayment($request_data_json,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..

        //store paymentID and your account number for matching in callback request
        // dd($response) //if you are using sandbox and not submit info to bkash use it for 1 response

        if (isset($response['bkashURL'])) return redirect()->away($response['bkashURL']);
        else return redirect()->back()->with('error-alert2', $response['statusMessage']);
    }

    public function callBack(Request $request)
    {
        //callback request params
        // paymentID=your_payment_id&status=success&apiVersion=1.2.0-beta
        //using paymentID find the account number for sending params

        if ($request->status == 'success') {
            $response = BkashPaymentTokenize::executePayment($request->paymentID);
            Log::info('Execute Payment Response:', ['response' => $response]);
            //$response = BkashPaymentTokenize::executePayment($request->paymentID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            if (!$response) { //if executePayment payment not found call queryPayment
                $response = BkashPaymentTokenize::queryPayment($request->paymentID);
                //$response = BkashPaymentTokenize::queryPayment($request->paymentID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
            }

            if (isset($response['statusCode']) && $response['statusCode'] == "0000" && $response['transactionStatus'] == "Completed") {

                // Store transaction in the database

                $user = Auth::user();
                $event_id = $request->event_id; // ✅ Ensure event ID is passed
                $event = Event::find($event_id);

                if ($user && $event) {
                    // Ensure reg_fee is set, fallback to the value passed in the request
                    $reg_fee = $request->amount;  // Get the amount from the request

                    // If for some reason reg_fee is still null, you can default to zero
                    if (is_null($reg_fee)) {
                        $reg_fee = 1015;
                    }

                    EventReg::create([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'tshirt_size' => $user->tshirt_size,
                        'attendance' => $request->attendance ?? 'present', // Default to 'present'
                        'guest_status' => $request->guest_status ?? 'no_guest', // Default to 'no_guest'
                        'adult_guest_count' => $request->adult_guest_count ?? 0, // Default to 0
                        'child_guest_count' => $request->child_guest_count ?? 0, // Default to 0
                        'guest_fee' => $request->guest_fee ?? 0, // Default to 0
                        'payment_method' => 'bkashpay',
                        'reg_fee' => $reg_fee,
                        'trx_id_bkash' => $response['trxID'], // ✅ trxID is stored
                        'verified' => 'paymentverified',
                    ]);
                }

                return redirect()->route('dashboard')->with('message', 'Payment successful!');
            }

            return redirect()->route('dashboard')->with('error', 'Payment Failed!');
        } elseif ($request->status == 'cancel') {
            return redirect()->route('dashboard')->with('error', 'Payment Aborted!');
        } else {
            return redirect()->route('dashboard')->with('error', 'Transaction Failed!');
        }
    }

    public function searchTnx($trxID)
    {
        //response
        return BkashPaymentTokenize::searchTransaction($trxID);
        //return BkashPaymentTokenize::searchTransaction($trxID,1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }

    public function refund(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        $amount = 5;
        $reason = 'this is test reason';
        $sku = 'abc';
        //response
        return BkashRefundTokenize::refund($paymentID, $trxID, $amount, $reason, $sku);
        //return BkashRefundTokenize::refund($paymentID,$trxID,$amount,$reason,$sku, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
    public function refundStatus(Request $request)
    {
        $paymentID = 'Your payment id';
        $trxID = 'your transaction no';
        return BkashRefundTokenize::refundStatus($paymentID, $trxID);
        //return BkashRefundTokenize::refundStatus($paymentID,$trxID, 1); //last parameter is your account number for multi account its like, 1,2,3,4,cont..
    }
}
