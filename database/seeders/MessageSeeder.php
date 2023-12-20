<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $messages = config('db_messages.messages');
        $apartments = Apartment::all();

        foreach($messages as $message) {

            $new_message = new Message();
            $new_message->name = $message['name'];
            $new_message->message = $message['message'];
            $new_message->email = $message['email'];
            $new_message->apartment_id = rand(1, 12);
            $new_message->subject = 'information about ' . $apartments[$new_message->apartment_id - 1]->title;
            $new_message->save();
        }
    }
}
