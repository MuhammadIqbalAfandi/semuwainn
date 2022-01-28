<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ServiceUnit;

class ServiceUnitController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        $serviceUnit = ServiceUnit::all();
        return $serviceUnit;
    }
}
