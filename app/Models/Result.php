<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = ['answer_id', 'poll_id'];
    use HasFactory;

    public function answer()
    {
        return $this->belongsTo(Answer::class);
    }

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
}
