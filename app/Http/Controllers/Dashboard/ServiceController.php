<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Models\ServiceOrder;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.service.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        try {
            Service::create($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.store.service'),
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
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        if ($service) {
            return response()->json(
                [
                    'id' => $service->id,
                    'name' => $service->name,
                    'unit' => $service->unit,
                    'price' => $service->getRawOriginal('price'),
                ],
                200,
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateServiceRequest $request, Service $service)
    {
        try {
            $service->update($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.update.service'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
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
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.service'),
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

    public function services()
    {
        $service = Service::latest();
        if ($service) {
            return DataTables::of($service)
                ->addColumn('actions', function (Service $service) {
                    return view('components.shared.action-btn',
                        [
                            'id' => $service->id,
                            'btnDeleteHide' => !ServiceOrder::where('service_id', $service->id)->first(),
                        ]);
                })
                ->make(true);
        };
    }
}
