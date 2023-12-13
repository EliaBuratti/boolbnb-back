<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Braintree;
use Illuminate\Http\Request;

class PaymentController extends Controller
{

    public function index(Request $request)
{
    $payload = $request->input('payload', false);
    $nonce = $payload['nonce'];

    $status = Braintree::sale([
	'amount' => '10.00',
	'paymentMethodNonce' => $nonce,
	'options' => [
	    'submitForSettlement' => True
	]
    ]);

    return response()->json($status);
}

    public function token() {

        $gateway = new \Braintree\Gateway([
            'environment' => env('BRAINTREE_ENVIRONMENT'),
            'merchantId' => env('BRAINTREE_MERCHANT_ID'),
            'publicKey' => env('BRAINTREE_PUBLIC_KEY'),
            'privateKey' => env('BRAINTREE_PRIVATE_KEY')
        ]);
    
        $clientToken = $gateway->clientToken()->generate();
    
        // Restituisci il token client o passalo alla tua vista
        return $clientToken;
    }
}
