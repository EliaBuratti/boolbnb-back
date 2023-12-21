<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Apartment;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user_id = auth()->user()->id;

        $apartments = Apartment::where('user_id', $user_id)->with('messages')->get();

        $messages_list = [];
        foreach ($apartments as $apartment) {

            foreach ($apartment['messages'] as $message) {
                array_unshift($messages_list, $message);
            }
        }

        $messages = collect($messages_list)->sortByDesc('created_at')->values()->all();


        return view('host.messages.index', compact('messages'));
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
    public function store(StoreMessageRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageRequest $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message)
    {
        $message->forceDelete();

        return to_route('host.messages.index')->with('message', 'Message deleted successfully');
    }
}
