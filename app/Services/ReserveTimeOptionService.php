<?php

namespace App\Services;

use App\Reservation;
use Carbon\Carbon;

/**
 * 予約時刻作成Service
 *
 * Class ReserveTimeOptionService
 * @package App\Services
 */
class ReserveTimeOptionService
{
    public function makeTimeOptions(Carbon $time)
    {
        $timeOptions = [];
        $targetTime = $time;

        // 24時間後までの予約時間の選択肢を作成する
        for ($index = 0; $index < 24; $index++) {
            if ($index !== 0) {
                $targetTime = $time->copy()->addHour($index)->setMinute(0);
            }
            $timeOptions = array_merge($timeOptions, $this->makeTimeOptionsForTargetHour($targetTime));
        }

        return $timeOptions;
    }

    public function makeTimeOptionsForTargetHour(Carbon $targetTime)
    {
        $timeOptions = [];

        if ($targetTime->hour >= Reservation::SHORT_RESERVATION_TIME_START_HOUR ||
            $targetTime->hour <= Reservation::SHORT_RESERVATION_TIME_END_HOUR) {
            // 作成しようとした予約開始時刻が朝の時間帯の範囲の場合は、20分単位で選択肢を作成
            $startMinutes = [0, 20, 40];
        } else {
            $startMinutes = [0, 30];
        }

        foreach ($startMinutes as $startMinute) {
            if ($targetTime->minute <= $startMinute) {
                $timeOptions[] = $targetTime->format('Y-m-d') . ' '
                    . sprintf('%2d', $targetTime->hour) . ':'
                    . sprintf('%2d', $startMinute) . ':00';
            }
        }
        return $timeOptions;
    }
}
