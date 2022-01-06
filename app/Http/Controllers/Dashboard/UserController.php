<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\QueryException;
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
                    'message' => __('messages.success.store.user'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollback();

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
                    'message' => __('messages.success.update.user'),
                    'status' => 'success',
                ],
                201,
            );
        } catch (QueryException $e) {
            DB::rollback();

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
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->status = !$user->status;
        $user->update();

        if ($user->status) {
            $msg = __('messages.users.active_user');
        } else {
            $msg = __('messages.users.no_active_user');
        }

        return response()->json(
            [
                'message' => $msg,
                'status' => 'success',
            ],
            200,
        );
    }

    public function users()
    {
        $users = User::with('role')->latest()->paginate(10);
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
}
