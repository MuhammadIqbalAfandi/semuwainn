<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\QueryException;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomRequest $request)
    {
        try {
            Room::create($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.store.room'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.errors.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
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
        try {
            $room->update($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.update.room'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.errors.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        try {
            $room->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.room'),
                    'status' => 'success',
                ],
                200,
            );
        } catch (QueryException $e) {
            return response()->json(
                [
                    'message' => __('messages.errors.destroy.all'),
                    'status' => 'failed',
                ],
                422,
            );
        }

    }

    public function rooms()
    {
        $rooms = Room::with(['roomType.roomPrices', 'roomOrders'])->latest()->paginate(10);
        if ($rooms) {
            return response()->json($rooms, 200);
        }
    }

    public function roomTypes()
    {
        $roomTypes = RoomType::latest()->get();
        if ($roomTypes) {
            return response()->json($roomTypes, 200);
        }
    }
}