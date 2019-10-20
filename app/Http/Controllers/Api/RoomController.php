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

    public function index()
    {
        $rooms = Room::all();
        $rooms->load('roomScores', 'roomFiles.file');

        return response()->json(['rooms' => $rooms]);
    }

    public function show(Request $request, Room $room)
    {
        $room->load('roomScores', 'roomFiles.file');
        return response()->json(['room' => $room]);
    }

}
