<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Privacy\StorePrivacyRequest;
use App\Models\Privacy;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privacy = Privacy::get()->first();
        $privacy = $privacy->text ?? '-';
        return view('pages.dashboard.privacy.create', compact('privacy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePrivacyRequest $request)
    {
        try {
            Privacy::truncate();
            Privacy::create($request->validated());

            return back()->with('success', __('messages.success.store.privacy'));
        } catch (QueryException $e) {
            return back()->with('failed', __('messages.errors.store.all'));
        }
    }
}
