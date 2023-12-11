<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_title',
        'da_title',
        'pa_title',
        'image',
        'status',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
}
