<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Show extends Model
{
    protected $fillable = [
        'type_id',
        'photo',
        'url',
        'caption'
    ];
    
    use HasFactory;
}
