<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    public function posts()
    {
        // return $this->belongsToMany(Post::class, 'category_post', 'post_id', 'category_id')->withTimestamps();
        return $this->belongsToMany(Post::class)->withTimestamps();
    }
}
