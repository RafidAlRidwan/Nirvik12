<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'comments';
    protected $fillable = [
        'parent_id', 'blog_id', 'comment', 'like_count', 'comment_by'
    ];
    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'comment_by');
    }
    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }
}
