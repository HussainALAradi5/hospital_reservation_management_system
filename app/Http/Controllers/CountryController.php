<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'official_name' => 'nullable|string|max:255',
            'code' => 'required|string|size:2',
            'flag_url' => 'nullable|url',
        ]);

        Country::create($request->only(['name', 'official_name', 'code', 'flag_url']));

        return redirect()->route('countries.index')->with('success', 'Country added successfully.');
    }

    public function show(Country $country)
    {
        return view('countries.show', compact('country'));
    }

    public function edit(Country $country)
    {
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, Country $country)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'official_name' => 'nullable|string|max:255',
            'code' => 'required|string|size:2',
            'flag_url' => 'nullable|url',
        ]);

        $country->update($request->only(['name', 'official_name', 'code', 'flag_url']));

        return redirect()->route('countries.index')->with('success', 'Country updated successfully.');
    }

    public function destroy(Country $country)
    {
        $country->delete();

        return redirect()->route('countries.index')->with('success', 'Country deleted successfully.');
    }

    public function sync(CountryService $service)
    {
        try {
            $countries = $service->fetchCountries();
            $count = $service->storeCountries($countries);

            return redirect()->route('countries.index')->with('success', "$count countries synced successfully.");
        } catch (\Exception $e) {
            return redirect()->route('countries.index')->with('error', 'Sync failed: ' . $e->getMessage());
        }
    }
}