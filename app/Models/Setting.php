<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillabl = [
        'en_nav_title',
        'da_nav_title',
        'pa_nav_title',
        'en_nav_subtitle',
        'da_nav_subtitle',
        'pa_nav_subtitle',
        'phone',
        'email',
        'en_province',
        'da_province',
        'pa_province',
        'en_street',
        'da_street',
        'pa_street',
        'en_exact_address',
        'da_exact_address',
        'pa_exact_address',
        'map_location',
        'en_about_us',
        'da_about_us',
        'pa_about_us',

        'tab_icon',
        'nav_logo'
    ];

    public function Images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
