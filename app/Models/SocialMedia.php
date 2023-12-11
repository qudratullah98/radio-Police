<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'en_title',
        'da_title',
        'pa_title',
        'url',
        'status',
        'created_by',
        'updated_by',
        'backgroundImage',
        'socialMediaIcon',
    ];

    public function Images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
