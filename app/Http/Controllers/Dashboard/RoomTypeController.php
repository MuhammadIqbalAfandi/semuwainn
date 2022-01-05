<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoomType\StoreRoomTypeRequest;
use App\Http\Requests\RoomType\UpdateRoomTypeRequest;
use App\Models\Facility;
use App\Models\RoomType;
use Exception;
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

    public function roomTypes()
    {
        $roomTypes = RoomType::with(['roomFacilities.facility', 'roomPrices', 'rooms'])->get();
        if ($roomTypes) {
            return response()->json(
                [
                    'roomTypes' => $roomTypes,
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
                    'message' => 'Ruangan baru berhasil ditambahkan',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'message' => 'Ruangan baru tidak berhasil ditambahkan',
                    'status' => 'failed',
                ],
                400,
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
                    'message' => 'Ruangan berhasil diubah',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'message' => 'Ruangan tidak berhasil diubah',
                    'status' => 'failed',
                ],
                400,
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
        $roomType->delete();
        return response()->json(
            [
                'message' => 'Ruangan berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
