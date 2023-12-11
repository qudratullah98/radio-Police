<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeek extends Model
{
    use HasFactory;

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
    public function programs()
    {
        return $this->belongsToMany(Program::class, 'day_of_week_programs', 'day_of_week_id');
    }
}
