<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PaymentRequest;
use App\Models\Apartment;
use Braintree\Gateway;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;
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

        //return redirect('https://www.youtube.com/shorts/pSq2Jgl430s');

        $userLogId = auth()->user()->id;  

        $apartments = Apartment::where('user_id', '=', $userLogId)->get();

        foreach($apartments as $apartment){
            
            //dd($apartment->id == $validatedData['apartmentid'] && $apartment->user_id == $userLogId);
            if($apartment->id == $validatedData['apartmentid'] && $apartment->user_id == $userLogId) {
                
                
                if(true){

                    $actualDate = date("Y-m-d H:i:s"); // Recupera la data e l'ora attuale
    
                    $sponsorship = DB::table('apartment_sponsorship')
                    ->where('apartment_id', $validatedData['apartmentid'])
                    ->where('end_sponsorship', '>=', $actualDate)
                    ->get()->last();
    
    
                    //$dateProva = date_diff(new DateTime(), $sponsorship->end_sponsorship);
                    //dd(!empty($sponsorship), $sponsorship);
                    //dd($sponsorship);

                    if(!empty($sponsorship) ) {

                        $date = $sponsorship->end_sponsorship;

                    } else {
                        $date = $actualDate;
                    }

                    $end_date = date("Y-m-d H:i:s", strtotime($date . ' + 1 day + 3 hours 30 minutes')); // Aggiunge un giorno alla data attuale

                    dd($end_date);
                    
                    $apartment->sponsorships()->attach($apartment->id,
                        [
                        'sponsorship_id' => $validatedData['sponsorship'],
                        'end_sponsorship' => $end_date,
                        ]);

                dd(!empty($sponsorship));
                
                    
                }


                dd($userLogId);    
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

