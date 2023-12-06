<?php

namespace Database\Seeders;

use App\Models\Sponsorship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sponsorships = [
            [
                "name" => 'Base',
                "price" => 2.99,
                "duration" => '24:00'
            ],
            [
                "name" => 'Advanced',
                "price" => 5.99,
                "duration" => "72:00"
            ],
            [
                "name" => 'Premium',
                "price" => 9.99,
                "duration" => "144:00"
            ],
        ];

        foreach ($sponsorships as $sponsorship) {

            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->save();
        }
    }
}
