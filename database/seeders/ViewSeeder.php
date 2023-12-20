<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 200; $i++) {
            $new_view = new View();
            $new_view->apartment_id = rand(1, 12);
            $new_view->ip_adress = "75.27.54." . rand(1, 999);
            $new_view->save();
        }
        for ($i = 0; $i < 200; $i++) {
            $new_view = new View();
            $new_view->apartment_id = rand(1, 12);
            $new_view->ip_adress = "75.27.54." . rand(1, 999);
            $new_view->created_at = "2023-11-18 17:01:31";
            $new_view->save();
        }
        for ($i = 0; $i < 200; $i++) {
            $new_view = new View();
            $new_view->apartment_id = rand(1, 12);
            $new_view->ip_adress = "75.27.54." . rand(1, 999);
            $new_view->created_at = "2023-10-18 17:01:31";
            $new_view->save();
        }
        for ($i = 0; $i < 200; $i++) {
            $new_view = new View();
            $new_view->apartment_id = rand(1, 12);
            $new_view->ip_adress = "75.27.54." . rand(1, 999);
            $new_view->created_at = "2023-09-18 17:01:31";
            $new_view->save();
        }
        for ($i = 0; $i < 200; $i++) {
            $new_view = new View();
            $new_view->apartment_id = rand(1, 12);
            $new_view->ip_adress = "75.27.54." . rand(1, 999);
            $new_view->created_at = "2023-08-18 17:01:31";
            $new_view->save();
        }
    }
}
