<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\View;
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use App\Models\Apartment;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = auth()->user()->id;

        $apartments = Apartment::where('user_id', $user_id)->get();
        foreach ($apartments as $apartment) {
            $apartmentID = $apartment['id'];

            $stats = View::where('apartment_id', $apartmentID)->get();
            //dd($stats);
        }
        /* 

FINIRE QUI E CONTROLLARE IL CONTROLLO DOVE C'È IL SALVATAGGIO DELLA VISITA, 
ORA COME ORA SE UTENTE 1 VISITA APPARTAMENTO 1 E POI VISITA APPARTAMENTO 2 SALVA SOLO LA VISITA AD APPARTAMENTO 1 : (


*/
        $messages = [];
        foreach ($apartments as $apartment) {

            foreach ($apartment['messages'] as $message) {
                array_push($messages, $message);
            }
        }

        return view('host.analitycs.index', compact('stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreViewRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(View $view)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
