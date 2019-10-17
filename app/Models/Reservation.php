<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * 予約を管理するclass
 * Class Reservations
 * @package App
 */
class Reservation extends Model
{
    use Notifiable;use Notifiable;

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

    public function routeNotificationForSlack()
    {
        return 'https://hooks.slack.com/services/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';
    }
}
