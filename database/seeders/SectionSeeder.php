<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::insert(
            [
                'name' => 'A',
                'shift' => 1,
            ],
        );
        Section::insert(

            [
                'name' => 'B',
                'shift' => 1,
            ],
        );
        Section::insert(
            [
                'name' => 'C',
                'shift' => 2,
            ],
        );
        Section::insert(
            [
                'name' => 'D',
                'shift' => 2,
            ],
        );
    }
}
