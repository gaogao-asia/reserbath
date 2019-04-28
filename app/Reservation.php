<?php

namespace App;

use Carbon\Carbon;
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

    // 7時〜11時台は20分単位の予約
    const SHORT_RESERVATION_TIME_START_HOUR = 7;
    const SHORT_RESERVATION_TIME_END_HOUR = 11;
    // 予約する時間枠の長さ
    const DEFAULT_RESERVATION_TIME_SPAN = 30;
    const SHORT_RESERVATION_TIME_SPAN = 20;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
