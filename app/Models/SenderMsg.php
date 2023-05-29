<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SenderMsg extends Model
{
    use HasFactory;
    protected $table = 'sender_msgs';
    protected $fillable = [
        'name', 'email', 'msg', 'browser_id'
    ];
}
