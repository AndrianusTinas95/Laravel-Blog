<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment', 'post_id', 'user_id'];

    public function post()
    {
        return $this->beLongsTo(Post::class);
    }
    public function user()
    {
        return $this->beLongsTo(User::class);
    }
}
