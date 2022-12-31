<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeAdvertisement extends Model
{
    protected $fillable = [
        'typeId',
        'ad',
        'url',
        'status',
    ];

    use HasFactory;
}
