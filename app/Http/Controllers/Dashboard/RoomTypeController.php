<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\StoreRoomTypeRequest;
use App\Http\Requests\RoomType\UpdateRoomTypeRequest;
use App\Models\Facility;
use App\Models\RoomType;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

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
        $roomType = $roomType->where('id', $roomType->id)->with(['roomFacilities.facility', 'roomPrices'])->first();
        $facilities = Facility::all();
        if ($roomType) {
            return response()->json(
                [
                    'roomType' => $roomType,
                    'facilities' => $facilities,
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
        $roomTypes = RoomType::with(['roomFacilities.facility', 'roomPrices', 'rooms'])->latest()->paginate(10);
        if ($roomTypes) {
            return response()->json($roomTypes, 200);
        }
    }

    public function facilities()
    {
        $facilities = Facility::latest()->get();
        if ($facilities) {
            return response()->json($facilities, 200);
        }
    }
}
