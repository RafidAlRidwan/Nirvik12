<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserDetail;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create(
            [
                'name' => 'superadmin',
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('1234'),
                'type' => 1,
            ]
        );
        if ($superadmin) {
            UserDetail::create([
                'user_id' => $superadmin->id,
                'full_name' => 'Super Admin',
                'email' => $superadmin->email,
                'section' => 1,
                'shift' => 1,
            ]);
        }
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('1234'),
            'type' => 2,
        ]);
        if ($admin) {
            UserDetail::create([
                'user_id' => $admin->id,
                'full_name' => 'Super Admin',
                'email' => $admin->email,
                'section' => 1,
                'shift' => 1,
            ]);
        }
    }
}
