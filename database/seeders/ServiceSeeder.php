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
        $services = config('db_services');

        foreach ($services as $service) {

            $new_service = new Service();
            $new_service->title = $service['name'];
            $new_service->slug = Str::slug($new_service->title, '-');
            $new_service->save();
        }
    }
}
