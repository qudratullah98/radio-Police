<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMeta extends Model
{
    use HasFactory;

    public function Post()
    {
        return $this->belongsTo(Post::class);
    }

    protected $filable = [
        'post_id',
        'likes',
        'views',
        'status',
    ];

    public function PostMetaComment()
    {
        return $this->hasMany(PostMetaComment::class, 'post_meta_id', 'id');
    }

}