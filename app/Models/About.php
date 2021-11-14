<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;
    protected $table = 'abouts';
    protected $fillable = [
        'description',
    ];

    public static function saveOrUpdate($request, $id = null)
    {
        $requestData = $request->all();
 
        if (is_null($id)) {
            $about = About::create($requestData);
        } else {
            $about = About::findOrFail($id);   
            $about->update($requestData);
        }
    }
}
