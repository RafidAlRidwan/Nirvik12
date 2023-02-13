<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tags';
    protected $guarded = [];

    protected $fillable = [
        'name', 'slugs'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_tag');
    }

    public static function createSlug($str, $delimiter = '-')
    {

        $unwanted_array = [
            'ś' => 's', 'ą' => 'a', 'ć' => 'c', 'ç' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ź' => 'z', 'ż' => 'z',
            'Ś' => 's', 'Ą' => 'a', 'Ć' => 'c', 'Ç' => 'c', 'Ę' => 'e', 'Ł' => 'l', 'Ń' => 'n', 'Ó' => 'o', 'Ź' => 'z', 'Ż' => 'z'
        ]; // Polish letters for example
        $str = strtr($str, $unwanted_array);

        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        $slug = '#' . $slug;
        return $slug;
    }
}
