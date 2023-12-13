<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PaymentRequest;
use Braintree\Gateway;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Request $request)
    {

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

public function genToken() {
    $gateway = $this->brainConfig();

    $clientToken = $gateway->clientToken()->generate();
    $data = [
        'success' => true,
        'client_token' => $clientToken
    ];
    return response()->json($data,200);
}

}

