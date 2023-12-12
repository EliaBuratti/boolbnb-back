<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ApartmentController extends Controller
{
    /* public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Apartment::orderByDesc('id')->paginate(12)
        ]);
    } */

    public function show($slug)
    {
        $apartment = Apartment::where('slug', $slug)->first();

        if ($apartment) {
            return response()->json([
                'success' => true,
                'result' => $apartment
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Page not found'
            ]);
        }
    }

    /**
     * filter apartments with query string
     */
    public function index(Request $request)
    {
        // Ottenere i parametri dalla query string
        $beds = $request->query('beds');
        $rooms = $request->query('rooms');
        $address = $request->query('location');

        //dd($beds, $rooms);

        if ($request->query->has('beds') || $request->query->has('rooms')) {
            //$apartments = Apartment::with(['services', 'sponsorships'])->where('beds', '>=', $beds)->get();
            //$apartments = Apartment::with(['services', 'sponsorships'])->where('rooms', '>=', $rooms)->get();
            $apartments = Apartment::with(['services', 'sponsorships'])
                ->where('beds', '>=', $beds)
                ->where('rooms', '>=', $rooms)
                ->get();
        } else {
            $apartments = Apartment::with(['services', 'sponsorships'])->get();
        }

        $key_tomtom = env('TOMTOM_KEY');
        $coordinate = "https://api.tomtom.com/search/2/geocode/{$address}.json?storeResult=false&limit=1&extendedPostalCodesFor=Geo&view=Unified&key={$key_tomtom}";
        $json = file_get_contents($coordinate);
        $obj = json_decode($json);
        $lat = $obj->results[0]->position->lat;
        $lon = $obj->results[0]->position->lon;

        $apartmentsList = [
            "geometryList" => [
                [
                    "position" => $lat . ',' . $lon,  //posizione che otteniamo dall'input dell'utente
                    "radius" => 2000,
                    "type" => "CIRCLE"
                ]
            ],
            "poiList" => []
        ];

        foreach ($apartments as $apartment) {
            $newApartment = [
                "position" => [
                    'lat' => $apartment['latitude'],
                    'lon' => $apartment['longitude'],
                ]
            ];

            array_push($apartmentsList['poiList'], $newApartment);
        }

        //$apartments = json_encode($apartmentsList);

        /* $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'accept' => '/',

        ])
            ->withBody(json_encode($apartmentsList), 'application/json')
            ->post("https://api.tomtom.com/search/2/geometryFilter.json?key={$key_tomtom}");

 */
        return response()->json([
            'success' => true,
            'result' => $apartments,
        ]);
    }
}
