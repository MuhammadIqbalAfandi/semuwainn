<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Models\Guest;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

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
     * @param  \App\Models\Guest $guest
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
        try {
            $guest->update($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.update.guest'),
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
     * @param  Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guest $guest)
    {
        try {
            $guest->delete();
            return response()->json(
                [
                    'message' => __('messages.success.destroy.guest'),
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

    public function guests()
    {
        $guest = Guest::latest();
        if ($guest) {
            return DataTables::of($guest)
                ->filterColumn('nik', function ($user, $keyword) {
                    $user->where('nik', 'like', "%{$keyword}%")
                        ->orWhere('email', 'like', "%{$keyword}%")
                        ->orWhere('phone', 'like', "%{$keyword}%");
                })
                ->addColumn('nik', function (Guest $guest) {
                    return view('components.shared.account-info',
                        [
                            'nik' => $guest->nik,
                            'phone' => $guest->phone,
                            'email' => $guest->email,
                        ]
                    );
                })
                ->addColumn('booking', fn(Guest $guest) => $guest->reservations->count())
                ->addColumn('actions', function (Guest $guest) {
                    return view('components.shared.action-btn',
                        [
                            'id' => $guest->id,
                            'btnDeleteHide' => !$guest->reservations->count(),
                        ]);
                })
                ->make(true);
        }
    }
}
