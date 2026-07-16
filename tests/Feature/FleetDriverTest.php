<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Fleet;
use App\Models\Driver;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FleetDriverTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_fleet_and_driver()
    {
        $fleet = Fleet::create([
            'name' => 'Toyota Avanza',
            'license_plate' => 'B 1234 CD',
            'year' => 2022,
            'engine_capacity' => '1500cc',
            'stnk_expiry_date' => '2027-01-01',
            'status' => 'Available'
        ]);

        $this->assertDatabaseHas('fleets', ['license_plate' => 'B 1234 CD']);

        $driver = Driver::create([
            'name' => 'Budi Santoso',
            'license_number' => '1234567890',
            'license_type' => 'SIM A',
            'license_expiry_date' => '2028-01-01',
            'phone' => '081234567890',
            'status' => 'Available'
        ]);

        $this->assertDatabaseHas('drivers', ['name' => 'Budi Santoso']);
    }
}
