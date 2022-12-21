<?php

namespace Database\Seeders;

use App\Models\Shift;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shift::insert(
            [
                'name' => 'Morning',
            ],
            [
                'name' => 'Day',
            ],
        );
    }
}
