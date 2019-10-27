<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ReserveTimeOptionService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Room;
use App\Models\RoomFile;
use App\Models\File;

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
        $this->file = new File();
        $this->roomFile = new RoomFile();
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

    public function create(Request $request)
    {
        $reserveTimeOptionService = new ReserveTimeOptionService();
        $now = Carbon::now();
        $timeOptions = $reserveTimeOptionService->makeTimeOptions($now);

        return response()->json([
            'timeOptions' => $timeOptions,
            'baseTime' => $now
        ]);
    }

    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
          'room_id'  => 'required',
          'bg_image' => 'required|mimes:jpg,png,webp'
        ]);

        if ($validator->fails()) {
            return redirect('/rooms');
        }

        \DB::transaction(function () use ($request) {

            if ($request->hasFile('bg_image')) {
                $file          = $request->file('bg_image');
                $fileUrl       = $this->file->upload($file);

                $fileModel = $this->file->create([
                    'url' => $fileUrl
                ]);

                $this->roomFile->create([
                    'room_id' => $request->get('room_id'),
                    'file_id' => $fileModel->id
                ]);
            }
        });

        return response()->json([]);
    }
}
