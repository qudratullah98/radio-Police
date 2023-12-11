<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $hidden = ['pivot'];
    protected $fillable = [
        'en_name',
        'da_name',
        'pa_name',
        'main_menu',
        'status',
        'created_by',
        'updated_by',
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_categories');
    }
}