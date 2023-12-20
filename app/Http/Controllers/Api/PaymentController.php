<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\PaymentRequest;
use App\Models\Apartment;
use App\Models\Image;
use App\Models\Sponsorship;
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
        $validatedData = $request->validate([
            'sponsorship' => ['required', 'numeric', 'exists:sponsorships,id'],
            'apartmentid' => ['required', 'numeric', 'exists:apartments,id'],
        ]);


        $sponsorships = Sponsorship::where('id', '=', $validatedData['sponsorship'])->get();
        $duration = explode(':', $sponsorships[0]->duration);

        $userLogId = auth()->user()->id;

        $apartments = Apartment::where('user_id', '=', $userLogId)->get();

        foreach ($apartments as $apartment) {

            if ($apartment->id == $validatedData['apartmentid'] && $apartment->user_id == $userLogId) {


                $nonce = $request->nonce;
                $gateway = $this->brainConfig();
                $status = $gateway->transaction()->sale([

                    'amount' => $sponsorships[0]->price,
                    'paymentMethodNonce' => $nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);

                //dd($status->success);
                if ($status->success) {

                    $actualDate = date("Y-m-d H:i:s"); //actual date

                    //get last row if end_sponsorhip is more than actual date
                    $sponsorship = DB::table('apartment_sponsorship')
                        ->where('apartment_id', $validatedData['apartmentid'])
                        ->where('end_sponsorship', '>=', $actualDate)
                        ->get()->last();

                    //if result not empty
                    if (!empty($sponsorship)) {

                        //setup end date to add new time
                        $date = $sponsorship->end_sponsorship;
                    } else {

                        $date = $actualDate;
                    }


                    $end_date = date("Y-m-d H:i:s", strtotime($date . '+' . $duration[0] . 'hours +' . $duration[1] . 'minutes +' . $duration[2] . 'seconds')); // date sum  ' + 1 day + 3 hours 30 minutes'

                    $apartment->sponsorships()->attach(
                        $apartment->id,
                        [
                            'sponsorship_id' => $validatedData['sponsorship'],
                            'end_sponsorship' => $end_date,
                        ]
                    );

                    //$gallery = Image::where('apartment_id', '=', $apartment->id)->get();
                    //dd(date('d-m-Y H:i', strtotime($end_date)));
                    return back()->with('message', 'Your apartment: ' . $apartment->title . ' is sponsored until the date: ' . date('d-m-Y', strtotime($end_date)) . ' at ' . date('H:i', strtotime($end_date)));
                }
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

    public function genToken()
    {
        $gateway = $this->brainConfig();

        $clientToken = $gateway->clientToken()->generate();
        $data = [
            'success' => true,
            'client_token' => $clientToken
        ];
        return response()->json($data, 200);
    }
}
