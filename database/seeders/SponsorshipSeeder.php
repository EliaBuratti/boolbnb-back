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
        $sponsorships = config('db_sponsorships');

        foreach ($sponsorships as $sponsorship) {

            $new_sponsorship = new Sponsorship();
            $new_sponsorship->title = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration = $sponsorship['duration'];
            $new_sponsorship->save();
        }
    }
}
