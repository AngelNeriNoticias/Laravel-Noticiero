<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StreamingVideo extends Model
{
    protected $fillable = [
        'url',
        'title',
        'active'
    ];

    use HasFactory;
}
