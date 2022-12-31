<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticker extends Model
{
    protected $fillable = [
        'name',
        'show',
        'order'
    ];

    use HasFactory;
}
