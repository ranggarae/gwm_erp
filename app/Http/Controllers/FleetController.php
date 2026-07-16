<?php
namespace App\Http\Controllers;

use App\Models\Fleet;
use Illuminate\Http\Request;

class FleetController extends Controller
{
    public function index()
    {
        $fleets = Fleet::all();
        return view('fleets.index', compact('fleets'));
    }

    public function create()
    {
        return view('fleets.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'license_plate' => 'required|string|unique:fleets',
            'year' => 'required|integer',
            'engine_capacity' => 'required|string',
            'stnk_expiry_date' => 'required|date',
        ]);
        
        $validated['status'] = 'Available';
        Fleet::create($validated);

        return redirect()->route('fleets.index')->with('success', 'Fleet created successfully.');
    }
}
