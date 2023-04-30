<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponsiblitySection extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'short_description', 'file'
    ];
}
