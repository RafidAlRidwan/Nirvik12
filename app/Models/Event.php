<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'title',
        'body',
        'date',
        'file'
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            $requestData['status'] = 1;
            $about = Event::create($requestData);
        } else {
            $about = Event::findOrFail($id);
            $about->update($requestData);
        }
    }
}
