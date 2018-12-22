<?php

namespace App\Http\Controllers;

use App\Http\Requests\VehicleGearTypeRequest;
use App\VehicleGearType;
use Session;

class VehicleGearTypesController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.vehicle-gear-type.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param VehicleGearTypeRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(VehicleGearTypeRequest $request)
    {
        $vehicleGearType = VehicleGearType::create(array(
            'name' => $request->name,
        ));

        Session::flash('status', [
            'vehicle_gear_type_add' => 'Successfully created gear type '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function edit(VehicleGearType $vehicleGearType)
    {
        return view('admin.vehicle-gear-type.edit', [
            'vehicleGearType' => $vehicleGearType
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param VehicleGearTypeRequest $request
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function update(VehicleGearTypeRequest $request, VehicleGearType $vehicleGearType)
    {
        $vehicleGearType->update($request->all());

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully updated gear type '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param VehicleGearType $vehicleGearType
     * @return \Illuminate\Http\Response
     */
    public function destroy(VehicleGearType $vehicleGearType)
    {
        try {
            $vehicleGearType->delete();
        } catch (\Exception $e) {
        }

        Session::flash('status', [
            'vehicle_gear_type' => 'Successfully deleted gear type '.$vehicleGearType->name
        ]);

        return redirect()->route('admin.home');
    }
}
