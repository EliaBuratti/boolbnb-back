<?php

namespace App\Http\Controllers\Host;


use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\View;
use App\Models\Message;
use App\Models\Service;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $total_services = Service::all()->count();
        $total_sponsorships = Sponsorship::all()->count();

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
        //dd($messages_a);

        $user_id = auth()->user()->id;

        $apartments = Apartment::where('user_id', $user_id)->get();
        //dd($apartments);

        $views = [];

        $totalViews = 0;

        foreach ($apartments as $i => $apartment) {
            $apartmentID = $apartment['id'];
            //dd($apartment['title']);
            //dd($apartmentID);
            $stats = View::where('apartment_id', $apartmentID)->count();
            //dd($stats);
            array_push($views, [$apartment['title'], $stats]);

            $totalViews += $stats;
            /*  $views += [
                $apartment['title'] => $stats
            ]; */
        }
        return view('dashboard', compact(['total_apartment', 'total_messages', 'totalViews', 'total_services', 'total_sponsorships']));
    }
}
