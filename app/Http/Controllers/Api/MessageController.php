<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        // Ottenere i parametri dalla query string
        $email = $request->query('email');
        $message = $request->query('message');
        $apartment_id = $request->query('apartment_id');

        if ($request->query->has('email') && $request->query->has('message') && $request->query->has('apartment_id')) {
            $messages = Message::all()
                ->where('email', '=', $email)
                ->where('message', '=', $message)
                ->where('apartment_id', '=', $apartment_id);
        }

        return response()->json([
            'success' => true,
            'result' => $messages
        ]);
    }
}
