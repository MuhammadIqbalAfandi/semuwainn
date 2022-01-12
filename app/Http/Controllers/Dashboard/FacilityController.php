<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\Facility\StoreFacilityRequest;
use App\Http\Requests\Facility\UpdateFacilityRequest;
use App\Models\Facility;
use App\Models\RoomFacility;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;

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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacilityRequest $request)
    {
        try {
            Facility::create($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.store.facility'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
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
        try {
            $facility->update($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.update.facility'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $th) {
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
     * @param  facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy(Facility $facility)
    {
        try {
            $facility->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.facility'),
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

    public function facilities()
    {
        $facility = Facility::latest();
        if ($facility) {
            return DataTables::of($facility)
                ->addColumn('room-count', function (Facility $facility) {
                    return $facility->roomFacilities->count();
                })
                ->addColumn('actions', function (Facility $facility) {
                    return view('components.shared.action-btn',
                        [
                            'id' => $facility->id,
                            'btnDeleteHide' => !RoomFacility::where('facility_id', $facility->id)->first(),
                        ]);
                })
                ->make(true);
        }
    }
}
