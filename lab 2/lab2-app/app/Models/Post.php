<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comment;


class Post extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function testingRelation()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    
}
