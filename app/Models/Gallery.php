<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;
use File;

class Gallery extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $fillable = [
        'title',
        'attachment',
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();
        // dd($requestData['attachment']);

        if (is_null($id)) {
            
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(800, 600);
                $image_resize->save('assets/user/landingPage/img/gallery/' . $filename);
                $requestData['attachment'] = $filename ?? NULL;
            }
            $gallery = Gallery::create($requestData);
        } else {

            // dd($requestData);
            $gallery = Gallery::findOrFail($id);
            if (!empty($requestData['attachment'])) {
                $image = $requestData['attachment'];
                $unique_date = date_timestamp_get(date_create());
                $filename = $unique_date . $image->getClientOriginalName();
                $image_resize = Image::make($image->getRealPath());
                $image_resize->resize(800, 600);
                $image_resize->save('assets/user/landingPage/img/gallery/' . $filename);
                $requestData['attachment'] = $filename ?? NULL;
            }
            $gallery->update($requestData);
        }
    }
}
