<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'key',
        'value'
    ];

    public static function onlyUpdate($request, $id = null)
    {
            // dd($requestData);
            
            $setting = Setting::all();
            
            // App Name
            $app_name = $setting->where('key', 'app_name')->first();
            if($app_name){
                $app_name->value = $request->app_name;
                $app_name->save();
            }
            
            // Banner
            $banner = $setting->where('key', 'banner')->first();
            if($banner){
                if (!empty($request->attachment)) {
                    $image_path = $banner->value; 
                    if (file_exists($image_path)) {
                        unlink($image_path);
                    }
                    $image = $request->attachment;
                    $unique_date = date_timestamp_get(date_create());
                    $filename = $unique_date . $image->getClientOriginalName();
                    $path = ('assets/user/landingPage/img/');
                    $image_resize = Image::make($image->getRealPath());
                    // $image_resize->resize(800, 600);
                    $main_path = $path.$filename;
                    $image_resize->save($main_path);
                    $request->attachment = $main_path ?? NULL;
                    $banner->value = $request->attachment;
                    $banner->save();
                }
                
            }

            // Footer Description
            $description = $setting->where('key', 'description')->first();
            if($description){
                $description->value = $request->description;
                $description->save();
            }

            // Footer Address
            $address = $setting->where('key', 'address')->first();
            if($address){
                $address->value = $request->address;
                $address->save();
            }

            // Footer Phone
            $phone = $setting->where('key', 'phone')->first();
            if($phone){
                $phone->value = $request->phone;
                $phone->save();
            }

            // Footer Email
            $email = $setting->where('key', 'email')->first();
            if($email){
                $email->value = $request->email;
                $email->save();
            }

            // Bkash
            $bkash = $setting->where('key', 'bkash')->first();
            if($bkash){
                $bkash->value = $request->bkash;
                $bkash->save();
            }

            // Nagad
            $nagad = $setting->where('key', 'nagad')->first();
            if($nagad){
                $nagad->value = $request->nagad;
                $nagad->save();
            }

            // Rocket
            $rocket = $setting->where('key', 'rocket')->first();
            if($rocket){
                $rocket->value = $request->rocket;
                $rocket->save();
            }

            // Help Line
            $help_line = $setting->where('key', 'help_line')->first();
            if($help_line){
                $help_line->value = $request->help_line;
                $help_line->save();
            }

            Cache::flush();
            Cache::rememberForever('settings', function () {
                return DB::table('settings')->get();
            });

    }
}
