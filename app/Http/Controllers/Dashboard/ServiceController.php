<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
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
                    'service' => $service,
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
        // service.name,
        // service.unit,
        // idMoneyFormat(service.price),
        // idDateFormat(service.updated_at),
        // btnAction
        $service = Service::all();
        if ($service) {
            return DataTables::of($service)
                ->addColumn('price', function (Service $service) {
                    return $service->price;
                })
                ->addColumn('updated_at', function (Service $service) {
                    return Carbon::parse($service->updated_at)->format('d/m/Y');
                })
                ->addColumn('actions', function (Service $service) {
                    return view('components.shared.button-action', ['id' => $service->id]);
                });
        };
    }
}
