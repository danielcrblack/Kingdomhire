<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        $this->call([
            WeeklyRatesTableSeeder::class,
            VehicleFuelTypesTableSeeder::class,
            VehicleGearTypesTableSeeder::class,
            VehicleTypesTableSeeder::class,
            VehiclesTableSeeder::class,
            VehicleImagesTableSeeder::class,
            ReservationsTableSeeder::class
        ]);
    }
}
