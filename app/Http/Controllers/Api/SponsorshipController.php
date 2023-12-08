<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sponsorship;
use Illuminate\Http\Request;

class SponsorshipController extends Controller
{
    // DA CONTROLLARE DOPO AVER ABBINATO SPONSORIZZAZIONI AGLI APPARTAMENTI
    public function index()
    {
        return response()->json([
            'success' => true,
            'result' => Sponsorship::with('apartments')->orderByDesc('id')->paginate(12)
        ]);
    }
}
