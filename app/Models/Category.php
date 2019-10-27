<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';

    protected $fillable = [
        'name'
    ];


    // Relations
    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class, 'category_id', 'id');
    }
}
