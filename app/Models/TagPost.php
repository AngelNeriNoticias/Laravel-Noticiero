<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagPost extends Model
{
    protected $fillable = [
        'tag_id',
        'post_id',
    ];
    
    use HasFactory;

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
