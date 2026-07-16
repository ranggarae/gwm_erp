<?php
namespace App\Http\Controllers;

use App\Models\FleetExpense;
use App\Models\Fleet;
use App\Models\Trip;
use Illuminate\Http\Request;

class FleetExpenseController extends Controller
{
    public function index()
    {
        $expenses = FleetExpense::with(['fleet', 'trip'])->get();
        return view('fleet_expenses.index', compact('expenses'));
    }

    public function create()
    {
        $fleets = Fleet::all();
        $trips = Trip::all();
        return view('fleet_expenses.create', compact('fleets', 'trips'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fleet_id' => 'required|exists:fleets,id',
            'trip_id' => 'nullable|exists:trips,id',
            'expense_type' => 'required|in:Fuel,Maintenance,Toll,Parking,Others',
            'amount' => 'required|numeric',
            'description' => 'required|string',
        ]);
        
        $validated['status'] = 'Pending';
        FleetExpense::create($validated);

        return redirect()->route('fleet-expenses.index')->with('success', 'Expense created successfully.');
    }

    public function approve($id)
    {
        $expense = FleetExpense::findOrFail($id);
        $expense->update(['status' => 'Approved', 'approved_by' => auth()->id() ?? 1]);
        return back()->with('success', 'Expense approved.');
    }

    public function postToFinance($id)
    {
        $expense = FleetExpense::findOrFail($id);
        try {
            $expense->postToFinance();
            return back()->with('success', 'Expense posted to Finance.');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
