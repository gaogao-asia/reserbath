<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';

    protected $fillable = [
        'category_id',
        'name',
        'content'
    ];

    // Relations
    public function category()
    {
        return $this->belongsTo(\App\Category::class, 'category_id', 'id');
    }
}
