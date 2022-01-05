<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Facility\StoreFacilityRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Models\Facility;
use Illuminate\Routing\Controller;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.facility.index');
    }

    public function facilities()
    {
        $facilities = Facility::with('roomFacilities')->get();
        if ($facilities) {
            return response()->json(
                [
                    'facilities' => $facilities,
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
    public function store(StoreFacilityRequest $request)
    {
        Facility::create($request->validated());
        return response()->json(
            [
                'message' => 'Fasilitas baru berhasil ditambahkan',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit(Facility $facility)
    {
        if ($facility) {
            return response()->json(
                [
                    'facility' => $facility,
                ],
                200,
            );
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacilityRequest $request, Facility $facility)
    {
        $facility->update($request->validated());
        return response()->json(
            [
                'message' => 'Fasilitas berhasil diubah',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        return response()->json(
            [
                'message' => 'Fasilitas berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
