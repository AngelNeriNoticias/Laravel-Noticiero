<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'show',
        'order',
        'show_menu'
    ];

    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class)->orderBy('order', 'asc');
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('id', 'desc');
    }
}
