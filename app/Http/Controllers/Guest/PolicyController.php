<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Policy;

class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policy = Policy::get()->first();
        $policy = $policy->text ?? '-';

        return inertia('Guest/Policy/Index', [
            'policy' => $policy,
        ]);
    }
}
