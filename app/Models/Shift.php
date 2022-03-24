<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;
    protected $table = 'shifts';

    public static function shiftInfo($id = NULL)
    {
        if(!empty($id)){
            $shift = Shift::where('id', $id)->first();
            return $shift->name;
        }
    }
}
