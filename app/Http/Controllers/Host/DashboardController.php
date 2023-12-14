<?php

namespace App\Http\Controllers\Host;


use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $user_id = auth()->user()->id;
        $total_apartment = Apartment::where('user_id', '=', $user_id)->count();


        /* $apartments = Apartment::where('user_id', '=', $user_id)->get();
        $apartments_ids = [];

        foreach ($apartments as $apartment) {

            $id = $apartment->id;

            array_push($apartments_ids, $id);
        } */
        //apartments_ids ora contiene gli id degli appartamenti che appartengono all'utente loggato

        //$total_messages = Message::where('apartment_id', '=', auth()->user()->apartments()->id)->count();


        return view('dashboard', compact('total_apartment'));
    }
}
