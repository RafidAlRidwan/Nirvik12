<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\ShiftSeeder;
use Database\Seeders\SectionSeeder;
use Database\Seeders\SettingsSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            SettingsSeeder::class,
            AboutSeeder::class,
            ShiftSeeder::class,
            SectionSeeder::class,
        ]);
    }
}
