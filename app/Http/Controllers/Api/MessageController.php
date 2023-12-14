<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        //dd($data);
        //dd($request);
        // Ottenere i parametri dalla query string
        $apartment_id = $request->query('apartment_id');
        $mail = $request->query('mail');
        $subject = $request->query('subject');
        $message = $request->query('body');
        $name = $request->query('name');

        /* if ($request->query->has('email') && $request->query->has('message') && $request->query->has('apartment_id')) {
            $messages = Message::all()
                ->where('email', '=', $mail)
                ->where('message', '=', $message)
                ->where('apartment_id', '=', $apartment_id);
        } */

        //dd($apartment_id, $mail, $name, $subject, $message);


        /* $data = array('apartment_id' => $apartment_id, "name" => $name, "subject" => $subject, "body" => $body, 'mail' => $mail);
        //dd($data);

        //DB::table('messages')->insert($data);
        Message::create($data); */

        $new_message = new Message();
        $new_message->apartment_id = $apartment_id;
        $new_message->name = $name;
        $new_message->subject = $subject;
        $new_message->message = $message;
        $new_message->email = $mail;
        $new_message->save();


        return response()->json([
            'success' => true,
            'message' => 'your message is sent to host : )'
        ]);
    }
}
