<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'autor', 'title', 'slug', 'image', 'body', 'view', 'status', 'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }
}
