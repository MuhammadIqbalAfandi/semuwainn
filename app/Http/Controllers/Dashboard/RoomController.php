<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Room\StoreRoomRequest;
use App\Http\Requests\Room\UpdateRoomRequest;
use App\Models\Room;
use App\Models\RoomOrder;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::none(['isAdmin', 'isLeader'])) {
            abort(403);
        }

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
        if ($room) {
            return response()->json(
                [
                    'roomNumber' => $room->room_number,
                    'roomTypeId' => $room->roomType->id,
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
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

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
        $room = Room::latest();
        if ($room) {
            return DataTables::of($room)
                ->addColumn('room-type', fn(Room $room) => $room->roomType->name)
                ->addColumn('status', function (Room $room) {
                    return view('components.room.status', ['roomCount' => $room->roomOrders->count()]);
                })
                ->addColumn('actions', function (Room $room) {
                    return view('components.shared.action-btn',
                        [
                            'id' => $room->id,
                            'btnDeleteHide' => !RoomOrder::where('room_id', $room->id)->first(),
                        ]);
                })
                ->make(true);
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
