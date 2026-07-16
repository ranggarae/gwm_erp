<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Fleet;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\FleetExpense;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TripExpenseTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_trip_and_expense()
    {
        $fleet = Fleet::create(['name' => 'Car', 'license_plate' => 'B 1', 'year' => 2020, 'engine_capacity' => '1.0', 'stnk_expiry_date' => '2025-01-01']);
        $driver = Driver::create(['name' => 'John', 'license_number' => '123', 'license_type' => 'A', 'license_expiry_date' => '2025-01-01', 'phone' => '123']);

        $trip = Trip::create([
            'fleet_id' => $fleet->id,
            'driver_id' => $driver->id,
            'route_destination' => 'Jakarta - Bandung',
            'purpose' => 'Meeting',
            'start_date' => now(),
            'start_odometer' => 10000,
            'status' => 'Scheduled'
        ]);

        $this->assertDatabaseHas('trips', ['route_destination' => 'Jakarta - Bandung']);
        $this->assertEquals($fleet->id, $trip->fleet->id);

        $expense = FleetExpense::create([
            'fleet_id' => $fleet->id,
            'trip_id' => $trip->id,
            'expense_type' => 'Fuel',
            'amount' => 150000,
            'description' => 'Isi bensin',
            'status' => 'Pending'
        ]);

        $this->assertDatabaseHas('fleet_expenses', ['expense_type' => 'Fuel', 'amount' => 150000]);
        $this->assertEquals($trip->id, $expense->trip->id);
    }
}
