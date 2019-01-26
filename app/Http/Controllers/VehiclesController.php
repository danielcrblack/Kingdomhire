<?php

namespace App\Http\Controllers;

use App\ChartGenerator;
use App\Reservation;
use App\WeeklyRate;
use App\VehicleType;
use App\VehicleGearType;
use App\VehicleFuelType;
use App\Vehicle;
use App\Http\Requests\VehicleStoreRequest;
use App\Http\Requests\VehicleUpdateRequest;
use Session;

class VehiclesController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activeVehicles = Vehicle::all()->sortBy('created_at');
        $inactiveVehicles = Vehicle::onlyTrashed()->get();
        $vehicleTypes = VehicleType::with(['vehicles' => function ($q) {
            $q->withTrashed();
        }])->get();

        return view('admin.admin-vehicles', [
            'vehicleTypes' => $vehicleTypes,
            'activeVehicles' => $activeVehicles,
            'inactiveVehicles' => $inactiveVehicles,
            'rates' => WeeklyRate::all(),
            'types' => VehicleType::all(),
            'fuelTypes' => VehicleFuelType::all(),
            'gearTypes' => VehicleGearType::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle.create', [
            'rates' => WeeklyRate::all(),
            'types' => VehicleType::all(),
            'fuelTypes' => VehicleFuelType::all(),
            'gearTypes' => VehicleGearType::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleStoreRequest $request)
    {
        $fuel_type_id = VehicleFuelType::whereName($request->fuel_type)->first()->id;
        $gear_type_id = VehicleGearType::whereName($request->gear_type)->first()->id;
        $type_id = VehicleType::whereName($request->type)->first()->id;
        $weekly_rate_id =  WeeklyRate::whereName($request->rate_name)->first()->id;

        $vehicle = Vehicle::create([
            'make' => $request->make,
            'model' => $request->model,
            'vehicle_fuel_type_id' => $fuel_type_id,
            'vehicle_gear_type_id' => $gear_type_id,
            'seats' => $request->seats,
            'vehicle_type_id' => $type_id,
            'weekly_rate_id' => $weekly_rate_id
        ]);

        if($request->hasFile('vehicle_images')) {
            $images = $request->file('vehicle_images');
            $vehicle->linkImages($images);
        }

        Session::flash('status', [
            'Successfully created vehicle!',
            'Vehicle Name = '.$vehicle->name(),
            'Vehicle Id = '.$vehicle->id,
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function show(Vehicle $vehicle)
    {
        $pastHires = $vehicle->getInactiveHires()->sortBy('end_date');
        ChartGenerator::drawOverallPastHiresBarChart($pastHires);

        if ($vehicle->trashed()) {
            return view('admin.vehicle.dashboards.discontinued', [
                'vehicle' => $vehicle,
                'pastHires' => $pastHires
            ]);
        }
        else {
            return view('admin.vehicle.dashboards.active', [
                'vehicle' => $vehicle,
                'gantt' => ChartGenerator::drawVehicleReservationsAndHiresGanttChart($vehicle),
                'pastHires' => $pastHires
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(Vehicle $vehicle)
    {
        return view('admin.vehicle.edit', [
            'vehicle' => $vehicle,
            'rates' => WeeklyRate::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleUpdateRequest $request
     * @param  \App\Vehicle $vehicle
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleUpdateRequest $request, Vehicle $vehicle)
    {
        $vehicle->status = ($request->vehicle_status == null) ? $vehicle->status : $request->vehicle_status;
        $vehicle->weekly_rate_id = ($request->rate_name != "") ? WeeklyRate::whereName($request->rate_name)->first()->id : null;
        $vehicle->save();

        if($request->hasFile('vehicle_images_add')) {
            $images = $request->file('vehicle_images_add');
            $vehicle->linkImages($images);
        }

        if($request->has('vehicle_images_del')) {
            $images = $request->get('vehicle_images_del');
            $vehicle->deleteImages($images);
        }

        Session::flash('status', [
            'edit' => 'Successfully edited '.$vehicle->name(),
            'Vehicle Name = '.$vehicle->name(),
            'Vehicle Id = '.$vehicle->id,
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehicle $vehicle)
    {
        $vehicle->forceDelete();

        Session::flash('status', [
            'vehicle' => 'Successfully deleted vehicle '.$vehicle->name()
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Soft delete the specified resource
     *
     * @param \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function discontinue(Vehicle $vehicle)
    {
        $vehicle->status = 'Unavailable';
        $vehicle->save();
        Reservation::destroy($vehicle->reservations->pluck('id')->toArray());
        if ($vehicle->hasActiveHire())  {
            $activeHire = $vehicle->getActiveHire();
            $activeHire->is_active = false;
            $activeHire->save();
        }

        try {
            $vehicle->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'discontinue' => 'Successfully discontinued '.$vehicle->name()
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }

    /**
     * Restore the specified resource
     *
     * @param \App\Vehicle  $vehicle
     * @return \Illuminate\Http\Response
     */
    public function recontinue(Vehicle $vehicle)
    {
        $vehicle->status = 'Available';
        $vehicle->save();
        $vehicle->restore();

        Session::flash('status', [
            're-continue' => 'Successfully re-continued '.$vehicle->name()
        ]);

        return redirect()->route('admin.vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }
}
