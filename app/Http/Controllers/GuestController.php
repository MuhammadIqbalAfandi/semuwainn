<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreGuestRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Models\Guest;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.guest.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Guest  $Guest
     * @return \Illuminate\Http\Response
     */
    public function show(Guest $guest)
    {
        if ($guest) {
            return response()->json(
                [
                    'guest' => $guest,
                ],
                201,
            );
        }

    }

    public function guests()
    {
        $guests = Guest::with('reservations')->get();
        if ($guests) {
            return response()->json(
                [
                    'guests' => $guests,
                ],
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestRequest $request)
    {
        Guest::create($request->validated());
        return response()->json(
            [
                'message' => 'Data tamu berhasil ditambahkan',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        if ($guest) {
            return response()->json(
                [
                    'guest' => $guest,
                ],
                200,
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        $guest->update($request->validated());
        return response()->json(
            [
                'message' => 'Akun user berhasil diubah',
                'status' => 'success',
            ],
            201,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();
        return response()->json(
            [
                'message' => 'Data Tamu berhasil dihapus',
                'status' => 'success',
            ],
            200,
        );
    }
}
