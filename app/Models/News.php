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
        'body'
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            $about = News::create($requestData);
        } else {
            $about = News::findOrFail($id);
            $about->update($requestData);
        }
    }
}
