<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.dashboard.user.index');
    }

    public function users()
    {
        $users = User::with('role')->get();
        $roles = Role::all();
        if ($users) {
            return response()->json(
                [
                    'users' => $users,
                    'roles' => $roles,
                    'authId' => auth()->user()->id,
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
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        try {
            User::create($request->validated());

            DB::commit();

            return response()->json(
                [
                    'message' => 'Akun user berhasil ditambahkan',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(
                [
                    'message' => 'Akun user baru tidak berhasil ditambahkan',
                    'status' => 'failed',
                ],
                400,
            );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        if ($user) {
            return response()->json(
                [
                    'user' => $user,
                    'roles' => $roles,
                ],
                200,
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();
        try {
            $user->update($request->validated());

            DB::commit();

            return response()->json(
                [
                    'message' => 'Akun user berhasil diubah',
                    'status' => 'success',
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(
                [
                    'message' => 'Akun user baru tidak berhasil diubah',
                    'status' => 'failed',
                ],
                400,
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = !$user->status;
        $user->update();

        if ($user->status) {
            $msg = 'Sukses mengaktifkan user';
        } else {
            $msg = 'Sukses memblokir user';
        }

        return response()->json(
            [
                'message' => $msg,
                'status' => 'success',
            ],
            200,
        );
    }
}
