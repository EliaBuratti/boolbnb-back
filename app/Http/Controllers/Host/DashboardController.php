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

        $apartments = Apartment::where('user_id', $user_id)->with('messages')->get();

        $messages = [];
        foreach ($apartments as $apartment) {

            foreach ($apartment['messages'] as $message) {
                array_push($messages, $message);
            }
        }

        $total_messages = count($messages);

        return view('dashboard', compact(['total_apartment', 'total_messages']));
    }
}
