<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
/**
 * 予約を管理するclass
 * Class Reservations
 * @package App
 */
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
    /**
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo(\App\User::class, 'user_id', 'id');
    }

}
