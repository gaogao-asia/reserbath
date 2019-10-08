<?php

namespace App;

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
        return $this->hasMany(\App\Post::class, 'category_id', 'id');
    }
}
