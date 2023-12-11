<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostMetaComment extends Model
{
    use HasFactory;

    public function PostMeta()
    {
        return $this->belongsTo(PostMeta::class, 'post_meta_id', 'id');
    }
}