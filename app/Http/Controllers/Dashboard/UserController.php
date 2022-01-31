<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ChangePasswordRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

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
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('pages.dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

        return view('pages.dashboard.user.edit', compact('user'));
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
            $user->fill($request->validated())->save();

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
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

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
        $user = User::with('role');
        if ($user) {
            return DataTables::of($user)
                ->addColumn('gender', fn(User $user) => $user->gender->gender)
                ->filterColumn('phone-email', function ($user, $keyword) {
                    $user->where('email', 'like', "%{$keyword}%")->orWhere('phone', 'like', "%{$keyword}%");
                })
                ->addColumn('phone-email', function (User $user) {
                    return view('components.shared.account-info',
                        [
                            'phone' => $user->phone,
                            'email' => $user->email,
                        ]
                    );
                })
                ->addColumn('role', fn(User $user) => $user->role->name)
                ->addColumn('status', function (User $user) {
                    return view('components.user.index.status', ['status' => $user->status, 'userId' => $user->id]);
                })
                ->addColumn('action', function (User $user) {
                    return view('components.user.index.action-btn', ['userId' => $user->id]);
                })
                ->make(true);
        };
    }

    public function user(User $user)
    {
        if ($user) {
            return response()->json($user, 200);
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            if (!Hash::check($request->current_password, auth()->user()->password)) {
                return response()->json(
                    [
                        'message' => __('messages.errors.change-password'),
                        'status' => 'success',
                    ],
                    202,
                );
            }

            auth()->user()->update(['password' => bcrypt($request->password)]);

            return response()->json(
                [
                    'message' => __('messages.success.update.change-password'),
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
}
