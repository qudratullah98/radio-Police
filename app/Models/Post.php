<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [

        'en_title',
        'da_title',
        'pa_title',
        'en_sub_title',
        'da_sub_title',
        'pa_sub_title',
        'en_description',
        'da_description',
        'pa_description',
        'status',

        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function PostMeta()
    {
        return $this->hasOne(PostMeta::class, 'post_id', 'id');
    }

    public function User()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'post_categories', 'post_id')->select('pa_name');
    }

    public function Images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    // public function category()
    // {
    //     return $this->belongsToMany(Category::class, 'post_categories', 'post_id')->select(array('id', 'name'));
    // }
}