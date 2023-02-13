<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogLike extends Model
{
    use HasFactory;
    protected $table = 'blog_likes';
    protected $fillable = [
        'blog_id', 'user_id'
    ];
}
