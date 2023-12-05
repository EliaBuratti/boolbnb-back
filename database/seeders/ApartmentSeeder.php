<?php

namespace Database\Seeders;

use App\Models\Apartment;
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
        //DA ATTIVARE
        //$apartments = config('db_apartments');


        //ELIMINARE QUESTO ARRAY
        $apartments = [
            "title" => "LA TORRE DEL MANGHEN: Agri-alloggio indipendente",
            "nation" => "Italy",
            "city" => "Rota D'imagna, Lombardia",
            "postal_code" => 24037,
            "address" => "Via V. Emanuele 30",
            /*         "latitude" =>
            "longitude" => */
            "rooms" => 4,
            "bathrooms" => 2,
            "beds" => 6,
            "m_square" => 220,
            "description" => "Informazioni su questo spazio
            Rilassati con tutta la famiglia in questo alloggio tranquillo, immerso nel verde della Valle Imagna.
            Casa completa di cucina, bagni, doccia, divano, tv, wifi, tavoli esterni, spazio per barbecue.
            Possibilità di passeggiate nel verde a piedi o in bicicletta, vicinanza ad aziende agricole, vicinanza a spa, ristoranti e pizzerie.
            Gestito da un'azienda agricola, al Vostro arrivo troverete un cestino di benvenuto con i loro prodotti.",
            "thumbnail" => '',
            "visible" => false,
        ];


        foreach ($apartments as $apartment) {


            $key_tomtom = env('TOMTOM_KEY');
            $address = $apartment['address'];
            $city = $apartment['city'];
            $nation = $apartment['nation'];

            $response = Http::get("https://api.tomtom.com/search/2/geocode/{$address}/{$city}/{$nation}.json?storeResult=false&lat=37.337&lon=-121.89&view=Unified&key={$key_tomtom}");

            $new_aparment = new Apartment();


            if ($response->successful()) {
                $new_aparment->latitude  = $response->json()['latitude'];
                $new_aparment->longitude  = $response->json()['longitude'];
            }

            $new_aparment->title = $apartment['title'];
            $new_aparment->slug = Str::slug($new_aparment->title, '-');
            $new_aparment->nation = $apartment['nation'];
            $new_aparment->city = $apartment['city'];
            $new_aparment->postal_code = $apartment['postal_code'];
            $new_aparment->address = $apartment['address'];
            /* $new_aparment->latitude = $apartment['latitude'];
            $new_aparment->longitude = $apartment['longitude']; */
            $new_aparment->rooms = $apartment['rooms'];
            $new_aparment->bathrooms = $apartment['bathrooms'];
            $new_aparment->beds = $apartment['beds'];
            $new_aparment->m_square = $apartment['m_square'];
            $new_aparment->description = $apartment['description'];
            $new_aparment->thumbnail = $apartment['thumbnail'];
            $new_aparment->visible = $apartment['visible'];
            $new_aparment->save();



            /* https://api.tomtom.com/search/2/geocode/Via%20V.%20Emanuele%2030%2CRota%20D%27imagna%2CItaly.json?storeResult=false&lat=37.337&lon=-121.89&view=Unified&key=ErWGwLDWMoU1IkiDQW5wIqoHWtq7bc93 */
            /* 'title' => 'LA TORRE DEL MANGHEN: Agri-alloggio indipendente',
                'nation' => 'Italy',
                'city' => 'Rota D'imagna',
                'postal_code' => 24037,
                'address' => 'Via V. Emanuele 30', */
        }
    }
}
