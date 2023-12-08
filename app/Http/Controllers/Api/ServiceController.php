<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Service::with('apartments')->orderByDesc('id')->paginate(50)
        ]);
    }

    //DA CONTROLLARE DOPO AVER ABBINATO I SERVIZI AGLI APPARTAMENTI
    public function show($slug)
    {
        $apartment = Service::with('apartments')->where('slug', $slug)->first()->apartments()->paginate(12);
        //dd($technology);
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
}
