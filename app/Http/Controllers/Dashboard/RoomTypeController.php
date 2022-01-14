<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\StoreRoomTypeRequest;
use App\Http\Requests\RoomType\UpdateRoomTypeRequest;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.room-type.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.dashboard.room-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoomTypeRequest $request)
    {
        DB::beginTransaction();
        try {
            $roomType = RoomType::create($request->validated());

            foreach ($request->facilities as $facility) {
                $roomType->roomFacilities()->create([
                    'facility_id' => $facility,
                ]);
            }

            foreach ($request->descriptions as $index => $description) {
                $roomType->roomPrices()->create([
                    'description' => $request->descriptions[$index],
                    'price' => $request->prices[$index],
                ]);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => __('messages.success.store.room-type'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollBack();

            return response()->json(
                [
                    'message' => __('messages.errors.store.all'),
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
    public function edit(RoomType $roomType)
    {
        return view('pages.dashboard.room-type.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoomTypeRequest $request, RoomType $roomType)
    {
        DB::beginTransaction();
        try {
            $roomType->update($request->validated());

            $roomType->roomFacilities()->delete();
            foreach ($request->facilities as $facility) {
                $roomType->roomFacilities()->updateOrCreate([
                    'facility_id' => $facility,
                ]);
            }

            $roomType->roomPrices()->delete();
            foreach ($request->descriptions as $index => $description) {
                $roomType->roomPrices()->updateOrCreate([
                    'description' => $request->descriptions[$index],
                    'price' => $request->prices[$index],
                ]);
            }

            DB::commit();

            return response()->json(
                [
                    'message' => __('messages.success.update.room-type'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollBack();

            return response()->json(
                [
                    'message' => __('messages.errors.update.all'),
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
    public function destroy(RoomType $roomType)
    {
        try {
            $roomType->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.room-type'),
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

    public function roomTypes()
    {
        $roomType = RoomType::latest();
        if ($roomType) {
            return DataTables::of($roomType)
                ->addColumn('facility', function (RoomType $roomType) {
                    return view('components.room-type.facilities', compact('roomType'));
                })
                ->addColumn('price', function (RoomType $roomType) {
                    return view('components.room-type.detail-price', compact('roomType'));
                })
                ->addColumn('room-count', fn(RoomType $roomType) => $roomType->rooms->count())
                ->addColumn('guest-count', fn(RoomType $roomType) => $roomType->number_of_guest)
                ->addColumn('actions', function (RoomType $roomType) {
                    return view('components.room-type.action-btn',
                        [
                            'id' => $roomType->id,
                            'btnDeleteHide' => !$roomType->rooms->count(),
                        ]);
                })
                ->make(true);
        }
    }

    public function facilities()
    {
        $facilities = Facility::latest()->get();
        if ($facilities) {
            return response()->json($facilities, 200);
        }
    }

    public function roomFacilities(RoomType $roomType)
    {
        if ($roomType) {
            return response()->json([
                'roomFacilities' => $roomType->roomFacilities,
                'facilities' => Facility::all(),
            ], 200);
        }
    }

    public function roomPrices(RoomType $roomType)
    {
        if ($roomType) {
            return response()->json($roomType->roomPrices->transform(fn($roomPrice) => [
                'price' => $roomPrice->getRawOriginal('price'),
                'description' => $roomPrice->description,
            ]), 200);
        }
    }
}
