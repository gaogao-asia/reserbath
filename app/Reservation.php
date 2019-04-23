<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * 予約を管理するclass
 * Class Reservations
 * @package App
 */
class Reservation extends Model
{
    protected $table = 'reservations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reserve_time',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
      return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
