<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayOfWeekProgram extends Model
{
    use HasFactory;
    protected $fillable = [
        'program_id',
        'day_of_week_id'
    ];
}
