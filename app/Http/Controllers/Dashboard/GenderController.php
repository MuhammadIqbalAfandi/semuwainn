<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Gender;

class GenderController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $genders = Gender::all();
        if ($genders) {
            return response()->json($genders, 200);
        }
    }
}
