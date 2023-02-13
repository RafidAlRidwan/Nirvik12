<?php

namespace App\Models;

use App\Models\User;
use App\Models\BlogLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title', 'description', 'attachment', 'posted_by'
    ];
    public function comment()
    {
        return $this->hasMany(Comment::class, 'blog_id')->where('parent_id', 0);
    }
    public function userDetails()
    {
        return $this->hasOne(UserDetail::class, 'user_id', 'posted_by');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'posted_by');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'blog_tag');
    }
    public function likes()
    {
        return $this->hasMany(BlogLike::class, 'blog_id');
    }
    public function likeCount()
    {
        return count($this->likes);
    }
}
