<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            'WiFi',
            'Parcheggio',
            'TV',
            'Cucina',
            'Lavatrice',
            'Asciugatrice',
            'Aria condizionata',
            'Riscaldamento',
            'Piscina',
            'Palestra',
            'Animali ammessi',
            'Accesso per disabili',
            'Ascensore',
            'Portineria',
            'Vista panoramica',
            'Balcone o terrazza',
            'Giardino',
            'Vicinanza ai mezzi pubblici',
            'Vicinanza a negozi e ristoranti',
        ];

        foreach ($services as $service) {

            $new_service = new Service();
            $new_service->name = $service;
            $new_service->slug = Str::slug($new_service->name, '-');
            $new_service->save();
        }
    }
}
