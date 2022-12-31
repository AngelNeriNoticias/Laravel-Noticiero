<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'sub_category_id',
        'user_id',
        'title',
        'body',
        'photo',
        'visitors',
        'share',
        'comments'
    ];
    
    use HasFactory;

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tagsPost(){
        return $this->hasMany(TagPost::class, 'id', 'id');
    }
}
