<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }

    protected $fillable = [
        'en_name',
        'da_name',
        'pa_name',

        'status',

        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];
}
