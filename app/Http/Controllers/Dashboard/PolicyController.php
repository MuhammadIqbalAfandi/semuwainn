<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Policy\StorePolicyRequest;
use App\Models\Policy;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Gate;

class PolicyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::denies('isAdmin')) {
            abort(403);
        }

        $policy = Policy::get()->first();
        $policy = $policy->text ?? '-';
        return view('pages.dashboard.policy.create', compact('policy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePolicyRequest $request)
    {
        try {
            Policy::truncate();
            Policy::create($request->validated());

            return back()->with('success', __('messages.success.store.policy'));
        } catch (QueryException $e) {
            dd($e);
            return back()->with('failed', __('messages.errors.store.all'));
        }
    }
}
