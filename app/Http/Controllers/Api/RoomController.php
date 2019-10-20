<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReserveTimeOptionService;
use Illuminate\Http\Request;

use App\Models\Room;

/**
 * House Room
 * Class RoomController
 * @package App\Http\Controllers\Www
 */
class RoomController extends Controller
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
        $rooms = Room::all();
        $rooms->load('roomScores', 'roomFiles.file');

        // foreach ($rooms as $key => $room) {
        //     $room = $room->toArray();
        //     foreach ($room['room_scores'] as $key => $value) {
        //         $room['totalScore'] = $value['score'] ++;
        //     }
        // }

        return response()->json(['rooms' => $rooms]);
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
        $post = Post::create([
            'category_id' => $request->get('category_id'),
            'name'        => $request->get('name'),
            'content'     => $request->get('content')
        ]);
        return response()->json(['post' => $post]);
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Post $post)
    {
        $post->load('category');
        return response()->json(['post' => $post]);
    }

    /**
     * @param Request $request
     * @param Reservation $reservation
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        $post->load('category');

        return response()->json(['post' => $post]);
    }
}
