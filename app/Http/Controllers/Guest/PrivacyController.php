<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Privacy;

class PrivacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $privacy = Privacy::get()->first();
        $privacy = $privacy->text ?? '-';

        return inertia('Guest/Privacy/Index', [
            'privacy' => $privacy,
        ]);
    }
}
