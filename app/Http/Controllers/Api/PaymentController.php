<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PaymentRequest;
use App\Models\Apartment;
use Braintree\Gateway;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class PaymentController extends Controller
{

    public function index(Request $request)
    {
        //dd($request);

        $validatedData = $request->validate([
            'sponsorship' => ['required', 'numeric', 'exists:sponsorships,id'],
            'apartmentid' =>['required', 'numeric','exists:apartments,id'],
        ]);

        $user_id = auth()->user()->id;  

        $apartments = Apartment::where('user_id', '=', $user_id)->get();

        foreach($apartments as $apartment){

            $idAppUser = $apartment->user_id;

            if($idAppUser === $user_id) {
                dd($apartment);
                if(true){
                    $apartment->sponsorships()->attach([$validatedData['sponsorship'],  '2023/12/23 12:13:03']);
                }

                dd($user_id);    
                $nonce = $request->nonce;
                $gateway = $this->brainConfig();
                $status = $gateway->transaction()->sale([
                'amount' => '10.00',
                'paymentMethodNonce' => $nonce,
                'options' => [
                    'submitForSettlement' => True
                    ]
                ]);
        
/*                 if($status->success){
                    $apartment->sponsorships()->attach([$apartment->id]);
                } */
                dd($status->success);// true o false if payment it'ok
                //dd(response()->json($status));
                return response()->json($status);

            } else {
                return redirect('https://www.youtube.com/shorts/pSq2Jgl430s');
            }
        }

        
       
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

