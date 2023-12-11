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

        foreach ($apartments as $apartment) {

            $address = $apartment['address'];
            $city = $apartment['city'];
            $nation = $apartment['nation'];

            //$response = Http::withoutVerifying()->get("https://api.tomtom.com/search/2/geocode/{$address} {$city} {$nation}.json?storeResult=false&lat=37.337&lon=-121.89&view=Unified&key={$key_tomtom}");
            $response = Apartment::getCoordinates($address, $city, $nation);
            $new_aparment = new Apartment();

            if ($response->successful()) {
                $new_aparment->latitude  = $response->json()['results'][0]['position']['lat'];
                $new_aparment->longitude  = $response->json()['results'][0]['position']['lon'];
            }

            $new_aparment->user_id = rand(1, User::all()->count());

            $new_aparment->title = $apartment['title'];
            $new_aparment->slug = Str::slug($new_aparment->title, '-');
            $new_aparment->nation = $apartment['nation'];
            $new_aparment->city = $apartment['city'];
            $new_aparment->postal_code = $apartment['postal_code'];
            $new_aparment->address = $apartment['address'];
            $new_aparment->rooms = $apartment['rooms'];
            $new_aparment->bathrooms = $apartment['bathrooms'];
            $new_aparment->beds = $apartment['beds'];
            $new_aparment->m_square = $apartment['m_square'];
            $new_aparment->description = $apartment['description'];
            $new_aparment->thumbnail = 'apartments/' . Str::slug($new_aparment->title, '-') . $apartment['thumbnail'];
            $new_aparment->visible = $apartment['visible'];
            $new_aparment->save();
        }
    }
}
