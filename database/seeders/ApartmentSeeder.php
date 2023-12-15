<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $apartments = config('db_apartments.apartments');

        foreach ($apartments as $i => $apartment) {

            $address = $apartment['address'] . ', ' . $apartment['city']  . ', ' . $apartment['nation'];
            $response = Apartment::getCoordinates($address);
            $new_aparment = new Apartment();

            if ($response->successful()) {
                $new_aparment->latitude  = $response->json()['results'][0]['position']['lat'];
                $new_aparment->longitude  = $response->json()['results'][0]['position']['lon'];
            }

            $new_aparment->user_id = rand(1, User::all()->count());

            $new_aparment->title = $apartment['title'];
            $new_aparment->slug = Str::slug($new_aparment->title, '-');
            $new_aparment->nation = $apartment['nation'];
            $new_aparment->apartment_code = $i + 1;
            $new_aparment->address = $address;
            $new_aparment->rooms = $apartment['rooms'];
            $new_aparment->bathrooms = $apartment['bathrooms'];
            $new_aparment->beds = $apartment['beds'];
            $new_aparment->m_square = $apartment['m_square'];
            $new_aparment->description = $apartment['description'];
            $new_aparment->thumbnail = 'apartments/' . 'apartment-' . $i + 1 . $apartment['thumbnail'];
            $new_aparment->visible = $apartment['visible'];
            $new_aparment->save();
        }

        foreach ($apartments as $apartment) {
        }
    }
}
