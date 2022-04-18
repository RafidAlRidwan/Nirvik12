<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;


class CoverPage extends Model
{
    use HasFactory;
    protected $table = 'cover_pages';
    protected $fillable = [
        'title',
        'description',
        'attachment',
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            
            $count = CoverPage::TotalCount();
            if($count < 5){
                if (!empty($requestData['attachment'])) {
                    $image = $requestData['attachment'];
                    $unique_date = date_timestamp_get(date_create());
                    $filename = $unique_date . $image->getClientOriginalName();
                    $path = ('assets/user/landingPage/slider/images/');
                    $image_resize = Image::make($image->getRealPath());
                    $image_resize->resize(2049, 1150);
                    $main_path = $path.$filename;
                    $image_resize->save($main_path);
                    $requestData['attachment'] = $main_path ?? NULL;
                }
                $coverPage = CoverPage::create($requestData);
                return true;
            } else{
                return false;
            }
            
            
            
        } else {

            $coverPage = CoverPage::findOrFail($id);
            $image_path = $coverPage->attachment; 
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $path = ('assets/user/landingPage/slider/images/');
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(2049, 1150);
                $main_path = $path.$filename;
                $image_resize->save($main_path);
                $requestData['attachment'] = $main_path ?? NULL;
            }
            $coverPage->update($requestData);
        }
    }

    public static function TotalCount(){
        $coverPage = CoverPage::all();
        return $coverPage->count();
    }
}
