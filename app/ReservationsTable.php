<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reserve_time',
    ];

    // Relations
    public function user()
    {
      return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

}
