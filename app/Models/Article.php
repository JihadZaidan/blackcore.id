<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $table = 'articles';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'category_id',
        'user_id',
        'cover_image',
        'is_published'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'articles_tags', 'article_id', 'tag_id')->withTimestamps();;
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
