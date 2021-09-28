<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomType;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.room.index');
    }

    public function rooms()
    {
        $rooms = Room::with(['roomType.roomPrices', 'roomOrder'])->get();
        if ($rooms) {
            return response()->json(
                [
                    'rooms' => $rooms,
                ],
                200,
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        Room::create($request->validated());
        return response()->json(
            [
                'message' => 'Kamar baru berhasil ditambahkan',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  RoomType $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        $room = $room->where('id', $room->id)->with('roomType')->first();
        $roomTypes = RoomType::all();
        if ($room) {
            return response()->json(
                [
                    'room' => $room,
                    'roomTypes' => $roomTypes,
                ],
                200,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomRequest $request, Room $room)
    {
        $room->update($request->validated());
        return response()->json(
           [
               'message' => 'Kamar berhasil diubah',
               'status' => 'success',
            ],
           201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        $room->delete();
        return response()->json(
            [
                'message' => 'Kamar berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
