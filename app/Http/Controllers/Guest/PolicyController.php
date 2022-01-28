<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Policy;

class PolicyController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $policy = Policy::get()->first();
        $policy = $policy->text ?? '-';

        return inertia('Guest/Policy/Index', [
            'policy' => $policy,
        ]);
    }
}
