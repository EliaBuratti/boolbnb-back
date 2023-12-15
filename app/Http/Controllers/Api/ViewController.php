<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\View;
use DateTime;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function index(Request $request)
    {
        //dd($request->query());
        $ip_adress = $request->query('ip_adress');

        $actualDate = date("Y-m-d H:i:s");
        $apartment_id = $request->query('apartment_id');
        $lastDate = View::where('ip_adress', $ip_adress)
            ->where('apartment_id', $apartment_id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($lastDate === null) {
            $lastDate = $actualDate;
        } else {
            $lastDate = $lastDate->created_at;
            $lastDate = new DateTime($lastDate);
            $lastDate = $lastDate->format('Y-m-d H:i:s');
        }


        $yesterday = new DateTime($actualDate);
        $yesterday->modify('-1 day');
        $yesterday = $yesterday->format('Y-m-d H:i:s');

        if ($lastDate <= $yesterday or $lastDate === $actualDate) {

            $new_view = new View();
            $new_view->apartment_id = $apartment_id;
            $new_view->ip_adress = $ip_adress;
            $new_view->save();
        } else {
            $status = false;
        }

        return response()->json([
            'success' => true,
            'dateNow' => $actualDate,
            'lastVisit' => $lastDate,
            'yesterday' => $yesterday

        ]);
    }
}
