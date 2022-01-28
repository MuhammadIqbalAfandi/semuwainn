<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $privacy = Privacy::get()->first();
        $privacy = $privacy->text ?? '-';

        return inertia('Guest/Privacy/Index', [
            'privacy' => $privacy,
        ]);
    }
}
