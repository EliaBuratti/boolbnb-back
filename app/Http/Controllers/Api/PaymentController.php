<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Braintree_Transaction;
use Braintree_Gateway;
use Braintree;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
    //dd($request->nonce);
    //$payload = $request->nonce;

    //$payload = $request->input('payload', false);
    //dd($payload);
    $nonce = $request->nonce;
    $gateway = $this->brainConfig();
    $status = $gateway->transaction()->sale([
	'amount' => '10.00',
	'paymentMethodNonce' => $nonce,
	'options' => [
	    'submitForSettlement' => True
	]
    ]);

    dd(response()->json($status));
    return response()->json($status);
}

public function brainConfig()
{
  return new \Braintree\Gateway([
                    'environment' => env('BTREE_ENVIRONMENT'),
                    'merchantId' => env('BTREE_MERCHANT_ID'),
                    'publicKey' => env('BTREE_PUBLIC_KEY'),
                    'privateKey' => env('BTREE_PRIVATE_KEY')
                ]);
}
}

