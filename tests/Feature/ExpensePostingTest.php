<?php
namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Fleet;
use App\Models\FleetExpense;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class ExpensePostingTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_post_approved_expense_to_core()
    {
        $fleet = Fleet::create(['name' => 'Car', 'license_plate' => 'B 1', 'year' => 2020, 'engine_capacity' => '1.0', 'stnk_expiry_date' => '2025-01-01']);
        
        $fleetExpense = FleetExpense::create([
            'fleet_id' => $fleet->id,
            'expense_type' => 'Maintenance',
            'amount' => 500000,
            'description' => 'Ganti Oli',
            'status' => 'Approved'
        ]);

        $fleetExpense->postToFinance();

        $this->assertEquals('Posted', $fleetExpense->fresh()->status);
        $this->assertNotNull($fleetExpense->fresh()->expense_id);
        
        // Assert core expense exists (assuming standard 'expenses' table format here or just verifying mock)
        $this->assertDatabaseHas('expenses', [
            'id' => $fleetExpense->fresh()->expense_id,
            'amount' => 500000
        ]);
    }
}
