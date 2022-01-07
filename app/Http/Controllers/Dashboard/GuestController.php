<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\StoreGuestRequest;
use App\Http\Requests\Guest\UpdateGuestRequest;
use App\Models\Guest;
use Illuminate\Database\QueryException;
use Illuminate\Support\Carbon;
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
     * @param  \App\Models\Guest $Guest
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGuestRequest $request)
    {
        try {
            Guest::create($request->validated());
            return response()->json(
                [
                    'message' => __('messages.success.store.guest'),
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
        $guest = Guest::with('reservations')->get();
        if ($guest) {
            return DataTables::of($guest)
                ->addColumn('nik', function (Guest $guest) {
                    return '<span class="d-block">' . $guest->nik . '</span>
                        <span class="d-block text-secondary">' . $guest->phone . '</span>
                        <span class="d-block text-secondary">' . $guest->email . '</span>'
                    ;
                })
                ->addColumn('booking', function (Guest $guest) {
                    return $guest->reservations->count();
                })
                ->addColumn('updated_at', function (Guest $guest) {
                    return Carbon::parse($guest->updated_at)->format('d/m/Y');
                })
                ->addColumn('actions', function (Guest $guest) {
                    return view('components.shared.button-action', ['id' => $guest->id]);
                })
                ->rawColumns(['nik'])
                ->make(true);
        }
    }
}
