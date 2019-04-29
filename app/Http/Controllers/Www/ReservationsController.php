<?php

namespace App\Http\Controllers\Www;

use App\Http\Controllers\Controller;
use App\Services\ReserveTimeOptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Reservation;

/**
 * 風呂予約管理コントローラー
 * Class ReservationsController
 * @package App\Http\Controllers\Www
 */
class ReservationsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reservations = Reservation::where('reserve_time', '>', Carbon::now())->get();
        return view('www.reservations.index', compact('reservations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        $reserveTimeOptionService = new ReserveTimeOptionService();
        $now = Carbon::now();
        $timeOptions = $reserveTimeOptionService->makeTimeOptions($now);

        $params = [
            'timeOptions' => $timeOptions,
            'baseTime' => $now,
        ];
        return view('www.reservations.create', $params);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // createのviewが表示された時点の時刻を基準として、選択された予約時刻を取得する
        $baseTime = Carbon::parse($request->get('base_time'));
        $reserveTimeOptionService = new ReserveTimeOptionService();
        $timeOptions = $reserveTimeOptionService->makeTimeOptions($baseTime);
        $selectedTimeOption = $timeOptions[$request->get('reserve_time')];

        $requestedTimeStartAt = Carbon::parse($selectedTimeOption);
        $requestedTimeEndAt = $requestedTimeStartAt->copy()->addMinute(30);
        // 同じ開始時刻の予約が入っていないか確認
        $duplicatedReservationExists = Reservation::where('reserve_time', '>=', $requestedTimeStartAt)
            ->where('reserve_time', '<', $requestedTimeEndAt)->exists();

        if ($duplicatedReservationExists) {
            return redirect(route('www.reservations.index'))
                ->with('alert', 'すでに予約が入っています。時間を変更して予約してください');
        } else {
            Reservation::create([
                'user_id' => $user->id,
                'reserve_time' => $requestedTimeStartAt
            ]);
            return redirect(route('www.reservations.index'))->with('notice', '予約しました。');
        }

    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Reservation $reservation)
    {
        return view('www.reservations.show', compact('reservation'));
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Reservation $reservation)
    {
        return view('www.reservations.edit', compact('reservation'));
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update($request->all());
        return redirect(route('www.reservations.show', compact('reservation')));
    }
}
