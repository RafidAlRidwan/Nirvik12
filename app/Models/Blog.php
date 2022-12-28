<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blogs';
    protected $fillable = [
        'title', 'description', 'attachment'
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
}
