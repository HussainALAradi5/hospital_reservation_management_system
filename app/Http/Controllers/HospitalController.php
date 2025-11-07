<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Region;
use App\Models\Address;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::with('region', 'address')->get();
        return view('hospitals.index', compact('hospitals'));
    }

    public function create()
    {
        $regions = Region::all();
        $addresses = Address::all();
        $selected_region = session('region_created');
        $selected_address = session('address_created');

        return view('hospitals.create', compact('regions', 'addresses', 'selected_region', 'selected_address'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'open_at' => 'required',
            'close_at' => 'required',
            'days_of_work' => 'required|string',
            'region_id' => 'nullable|exists:regions,id',
            'address_id' => 'nullable|exists:addresses,id',
        ]);

        if (!$request->region_id) {
            return redirect()->route('regions.create')->with('redirect_after', 'hospital.create');
        }

        if (!$request->address_id) {
            return redirect()->route('addresses.create')->with('redirect_after', 'hospital.create');
        }

        Hospital::create($request->only([
            'code', 'name', 'region_id', 'address_id',
            'open_at', 'close_at', 'days_of_work',
        ]));

        return redirect()->route('hospitals.index')->with('success', 'Hospital created successfully.');
    }

    public function edit(Hospital $hospital)
    {
        $regions = Region::all();
        $addresses = Address::all();
        return view('hospitals.edit', compact('hospital', 'regions', 'addresses'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'name' => 'required|string|max:255',
            'region_id' => 'required|exists:regions,id',
            'address_id' => 'required|exists:addresses,id',
            'open_at' => 'required',
            'close_at' => 'required',
            'days_of_work' => 'required|string',
        ]);

        $hospital->update($request->only([
            'code', 'name', 'region_id', 'address_id',
            'open_at', 'close_at', 'days_of_work',
        ]));

        return redirect()->route('hospitals.index')->with('success', 'Hospital updated successfully.');
    }

    public function show($id)
{
    $hospital = Hospital::with('rooms')->findOrFail($id);
    return view('hospitals.show', compact('hospital'));
}
    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        return redirect()->route('hospitals.index')->with('success', 'Hospital deleted successfully.');
    }
}