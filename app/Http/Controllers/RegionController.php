<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
        {
            $regions = Region::all();
            return view('regions.index', compact('regions'));
        }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('regions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validate_array = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50',
       ];
       $request->validate($validate_array);
       Region::create($request->only('name', 'code'));
       return redirect()->route('regions.index')->with('success', 'Region created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
       return view('regions.show', compact('region'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        return view('regions.edit', compact('region'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $validate_array = [
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50',
       ];
       $request->validate($validate_array);
       $region->update($request->only('name', 'code'));
       return redirect()->route('regions.index')->with('success', 'Region updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
       $region->delete();
        return redirect()->route('regions.index')->with('success', 'Region deleted successfully.');
    }
}
