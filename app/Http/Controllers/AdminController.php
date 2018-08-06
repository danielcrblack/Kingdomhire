<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Hire;
use App\Vehicle;
use App\Reservation;
use App\VehicleRate;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeVehicles = Vehicle::whereIsActive(true)->get();
        $activeHires = Hire::whereIsActive(true)->get();
        $pastHires = Hire::whereIsActive(false)->get();
        $reservations = Reservation::all()->sortByDesc('start_date')->sortBy('end_date');
        ChartGenerator::drawReservationsBarChart($activeVehicles);
        ChartGenerator::drawPastHiresBarChart($pastHires);

        return view('admin.admin-dashboard', [
            'vehicles' => $activeVehicles,
            'activeHires' => $activeHires,
            'pastHires' => $pastHires,
            'reservations' => $reservations,
            'rates' => VehicleRate::all()
        ]);
    }
}

