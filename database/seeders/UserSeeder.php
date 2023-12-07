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
        $users = config('db_users.users');

        foreach ($users as $user) {
            $new_users = new User();
            $new_users->name = $user['name'];
            $new_users->last_name = $user['last_name'];
            //$new_users->city = $user['city'];
            //$new_users->postal_code = $user['postal_code'];
            //$new_users->address = $user['address'];
            $new_users->date_of_birth = $user['date_of_birth'];
            //$new_users->phone = $user['phone'];
            //$new_users->host = $user['host'];
            //$new_users->thumb = $user['thumb'];
            $new_users->email = $user['email'];
            $new_users->email_verified_at = $user['email_verified_at'];
            $new_users->password = $user['password'];
            $new_users->save();
        }
    }
}
