<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

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
        'start',
        'end',
        'status',
        'image',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at'
    ];

    public function day_of_weeks()
    {
        return $this->belongsToMany(DayOfWeek::class, 'day_of_week_programs', 'program_id');
    }
    public function Images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
