<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

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

        //dd($beds, $rooms);

        if ($request->query->has('beds') || $request->query->has('rooms')) {
            //$apartments = Apartment::with(['services', 'sponsorships'])->where('beds', '>=', $beds)->get();
            //$apartments = Apartment::with(['services', 'sponsorships'])->where('rooms', '>=', $rooms)->get();
            $apartments = Apartment::with(['services', 'sponsorships'])->where('beds', '>=', $beds)->where('rooms', '>=', $rooms)->get();
        } else {
            $apartments = Apartment::with(['services', 'sponsorships'])->get();
        }

        return response()->json([
            'success' => true,
            'result' => $apartments,
        ]);
    }
}
