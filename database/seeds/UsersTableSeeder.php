<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'confirmed' => 1,
            'admin' => 1,
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
        ]);
        \App\Models\User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user'),
            'confirmed' => 1,
            'confirmation_code' => md5(microtime() . env('APP_KEY')),
        ]);
    }
}