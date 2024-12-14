<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function newAppSchedule()
    {
        $services = Service::all();
        return view('Homepage.newappscheduled', compact('services'));
    }
}

