<?php
namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Fleet;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['fleet', 'driver'])->get();
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $fleets = Fleet::all();
        $drivers = Driver::all();
        return view('trips.create', compact('fleets', 'drivers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'fleet_id' => 'required|exists:fleets,id',
            'driver_id' => 'required|exists:drivers,id',
            'route_destination' => 'required|string',
            'purpose' => 'required|string',
            'start_date' => 'required|date',
            'start_odometer' => 'required|integer',
        ]);
        
        $validated['status'] = 'Scheduled';
        Trip::create($validated);

        return redirect()->route('trips.index')->with('success', 'Trip created successfully.');
    }
}
