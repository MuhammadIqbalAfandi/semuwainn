<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;

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

    public function services()
    {
        $services = Service::all();
        if ($services) {
            return response()->json(
                [
                    'services' => $services,
                ],
                200,
            );
        };
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        Service::create($request->validated());
        return response()->json(
            [
                'message' => 'Layanan berhasil ditambahkan',
                'status' => 'success',
            ],
            201,
        );
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
        $service->update($request->validated());
        return response()->json(
            [
                'message' => 'Layanan berhasil diubah',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json(
            [
               'message' => 'Layanan berhasil dihapus',
               'status' => 'success',
            ],
            200,
        );
    }
}
