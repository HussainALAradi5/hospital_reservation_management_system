<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Region;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index()
    {
        $addresses = Address::with('region')->get();
        return view('addresses.index', compact('addresses'));
    }

    public function create()
    {
        $regions = Region::all();
        return view('addresses.create', compact('regions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'region_id' => 'required|exists:regions,id',
            'street' => 'required|string|max:255',
            'road' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'block' => 'required|string|max:255',
        ]);

        Address::create($request->all());

        return redirect()->route('addresses.index')->with('success', 'Address created successfully.');
    }

    public function show(Address $address)
    {
        return view('addresses.show', compact('address'));
    }

    public function edit(Address $address)
    {
        $regions = Region::all();
        return view('addresses.edit', compact('address', 'regions'));
    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'region_id' => 'required|exists:regions,id',
            'street' => 'required|string|max:255',
            'road' => 'required|string|max:255',
            'building' => 'required|string|max:255',
            'block' => 'required|string|max:255',
        ]);

        $address->update($request->all());

        return redirect()->route('addresses.index')->with('success', 'Address updated successfully.');
    }

    public function destroy(Address $address)
    {
        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Address deleted successfully.');
    }
}