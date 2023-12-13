<?php

namespace Database\Seeders;

use App\Models\Apartment;
use App\Models\Image;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $images = config('db_images.images');

        foreach ($images as $image) {

            $new_image = new Image();
            $new_image->img = 'apartments/apartment-' . $image['apartment_id'] . $image['img'];
            $new_image->apartment_id = $image['apartment_id'];
            $new_image->save();
            //.
        }
    }
}
