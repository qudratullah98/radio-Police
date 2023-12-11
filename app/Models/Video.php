<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        "created_by", "updated_by", "en_title", "da_title", "pa_title", "url", "url"
    ];
}
