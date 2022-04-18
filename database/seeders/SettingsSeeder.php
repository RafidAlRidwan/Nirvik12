<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->delete();
        $data = [
            ['key' => 'app_name','value' => "নির্ভীক'১২"],
            ['key' => 'banner','value' => "assets/user/landingPage/img/logoW.png"],
            ['key' => 'description','value' => "Bogra Zilla School (বগুড়া জিলা স্কুল) is one of the oldest high schools in the Bogra District of Bangladesh and one of the top-ranked schools in the country. It provides education from class three (Grade-3) to class ten (Grade-10). It was a private English medium school before becoming a public school."],
            ['key' => 'address','value' => "Bogura Zilla School, Bogura"],
            ['key' => 'phone','value' => "017xxxxxxxx"],
            ['key' => 'email','value' => "ask@nirvik12.com"],
        ];
        Setting::insert($data);
    }
}
