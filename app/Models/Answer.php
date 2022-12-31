<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['name', 'poll_id'];
    use HasFactory;

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}
