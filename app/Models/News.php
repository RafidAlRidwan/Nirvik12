<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $table = 'news';
    protected $fillable = [
        'heading',
        'body',
        'status'
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            $requestData['status'] = 1;
            $about = News::create($requestData);
        } else {
            $about = News::findOrFail($id);
            $about->update($requestData);
        }
    }
}
