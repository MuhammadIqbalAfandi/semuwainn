<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Copyright\StoreCopyrightRequest;
use App\Models\Copyright;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CopyrightController extends Controller
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

        $copyright = Copyright::get()->first();
        $copyright = $copyright->text ?? '-';
        return view('pages.dashboard.copyright.create', compact('copyright'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCopyrightRequest $request)
    {
        try {
            Copyright::truncate();
            Copyright::create($request->validated());

            return back()->with('success', __('messages.success.store.copyright'));
        } catch (QueryException $e) {
            return back()->with('failed', __('messages.errors.destroy.all'));
        }
    }
}
