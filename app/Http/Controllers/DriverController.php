<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('drivers.index', compact('drivers'));
    }

    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_number' => 'required|string',
            'license_type' => 'required|string',
            'license_expiry_date' => 'required|date',
            'phone' => 'required|string',
        ]);
        
        $validated['status'] = 'Available';
        Driver::create($validated);

        return redirect()->route('drivers.index')->with('success', 'Driver created successfully.');
    }
}
