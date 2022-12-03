<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('1234'),
                'type' => 1,
            ]
        );
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'type' => 2,
        ]);
        User::create([
            'name' => 'a1',
            'email' => 'a1@gmail.com',
            'password' => bcrypt('1234'),
            'type' => 3,
        ]);
    }
}
