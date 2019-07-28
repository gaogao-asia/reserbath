<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReserveTimeOptionService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ReservationRequest;

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
        $this->middleware('auth:api');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reservations = Reservation::where('reserve_time', '>', Carbon::now())->orderBy('reserve_time', 'asc')->get();
        $reservations->load('user');
        return response()->json(['reservations' => $reservations]);
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

        // $params = [
        //     'timeOptions' => $timeOptions,
        //     'baseTime' => $now,
        // ];
        return response()->json([
            'timeOptions' => $timeOptions,
            'baseTime' => $now
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        // createのviewが表示された時点の時刻を基準として、選択された予約時刻を取得する
        $baseTime = Carbon::parse($request->get('base_time'))->timezone('Asia/Tokyo');
        $reserveTimeOptionService = new ReserveTimeOptionService();
        $timeOptions = $reserveTimeOptionService->makeTimeOptions($baseTime);
        $selectedTimeOption = $timeOptions[$request->get('reserve_time')];

        $requestedTimeStartAt = Carbon::parse($selectedTimeOption);
        $requestedTimeEndAt = $requestedTimeStartAt->copy()->addMinute(30);
        // 同じ開始時刻の予約が入っていないか確認
        $duplicatedReservationExists = Reservation::where('reserve_time', '>=', $requestedTimeStartAt)
            ->where('reserve_time', '<', $requestedTimeEndAt)->exists();

        if ($duplicatedReservationExists) {
            $reservations = Reservation::all();

            return response()->json(['reservations' => $reservations]);
        } else {
            Reservation::create([
                'user_id' => $user->id,
                'reserve_time' => $requestedTimeStartAt
            ]);

            $reservations = Reservation::all();
            return response()->json(['reservations' => $reservations]);
        }

    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Reservation $reservation)
    {
        $reservation->load('user');
        return response()->json(['reservation' => $reservation]);
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
        $reservation->load('user');

        return response()->json(['reservation' => $reservation]);
    }
}
