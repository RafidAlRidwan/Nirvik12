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
        'description',
        'date',
        'venue',
        'time'
    ];

    protected $dates = ['date', 'time'];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();

        if (is_null($id)) {
            Event::create($requestData);
        } else {
            $event = Event::findOrFail($id);
            $event->update($requestData);
        }
    }
    public static function countAllEvents()
    {
        $data = self::get();
        return count($data);
    }
}
