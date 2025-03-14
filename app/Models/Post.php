<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;


    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'user_id',
        'published_at',
        'featured',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'featured' => 'boolean',
    ];

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', now());
    }

    public function scopeLatest($query)
    {
        $query->orderBy('published_at', 'desc');
    }

    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }

    public function getExcerpt(){
        return Str::limit(strip_tags($this->body), 200);
    }

    public function getReadingTime(){
        $wordCount = str_word_count(strip_tags($this->body));
        $readingTime = ceil($wordCount / 200);
        return $readingTime;
    }
}
