<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $new_admin = new User();
        $new_admin->name = 'Super';
        $new_admin->last_name = 'Admin';
        $new_admin->city = 'nessuna';
        $new_admin->postal_code = '42866';
        $new_admin->address = 'via garibaldi';
        $new_admin->date_of_birth = '1998/8/12';
        $new_admin->phone = 3485729660;
        $new_admin->host = true;
        $new_admin->thumb = null;
        $new_admin->email = 'admin@boolbnb.com';
        $new_admin->email_verified_at = '';
        $new_admin->password = 'password';
        $new_admin->save();
    }
}
