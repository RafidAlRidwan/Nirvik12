<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;


class Album extends Model
{
    use HasFactory;
    protected $table = 'albums';
    protected $fillable = [
        'title','attachment'
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $path = ('assets/user/landingPage/img/gallery/');
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(120, 120);
                $main_path = $path.$filename;
                $image_resize->save($main_path);
                $requestData['attachment'] = $main_path ?? NULL;
            }
            $album = Album::create($requestData);
        } else {
            $album = Album::findOrFail($id);
            $image_path = $album->attachment; 
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $path = ('assets/user/landingPage/img/gallery/');
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(120, 120);
                $main_path = $path.$filename;
                $image_resize->save($main_path);
                $requestData['attachment'] = $main_path ?? NULL;
            }
            $album->update($requestData);
        }
    }
}
