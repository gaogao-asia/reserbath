<?php

namespace App\Http\Controllers\Www;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Reservation;

/**
 * 風呂予約管理コントローラー
 * Class ReservationsController
 * @package App\Http\Controllers\Www
 */
class ReservationsController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $reservations = Reservation::all();
        return view('www.reservations.index', compact('reservations'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('www.reservations.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        Reservation::create(['user_id' => $user->id, $request->get('reserve_time')]);
        return redirect(route('www.welcome'));
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Reservation $reservation) {
        return view('www.reservations.show', compact('reservation'));
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Reservation $reservation) {
        return view('www.reservations.edit', compact('reservation'));
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Reservation $reservation) {
        $reservation->update($request->all());
        return redirect(route('www.reservations.show', compact('reservation')));
    }
}
