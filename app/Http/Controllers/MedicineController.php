<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Country;
use App\Models\MedicineCompany;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    public function index()
    {
        $medicines = Medicine::with(['country', 'company'])->get();
        return view('medicines.index', compact('medicines'));
    }

    public function create()
    {
        $countries = Country::all();
        $companies = MedicineCompany::all();
        return view('medicines.create', compact('countries', 'companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:medicines,code',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'product_country_id' => 'required|exists:countries,id',
            'medicine_company_id' => 'nullable|exists:medicine_companies,id',
        ]);

        Medicine::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'product_country_id' => $request->product_country_id,
            'medicine_company_id' => $request->medicine_company_id,
        ]);

        return redirect()->route('medicines.index')->with('success', 'Medicine added successfully.');
    }

    public function show(Medicine $medicine)
    {
        $medicine->load(['country', 'company']);
        return view('medicines.show', compact('medicine'));
    }

    public function edit(Medicine $medicine)
    {
        $countries = Country::all();
        $companies = MedicineCompany::all();
        return view('medicines.edit', compact('medicine', 'countries', 'companies'));
    }

    public function update(Request $request, Medicine $medicine)
    {
        $request->validate([
            'code' => 'required|string|max:255|unique:medicines,code,' . $medicine->id,
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'quantity' => 'required|integer|min:0',
            'product_country_id' => 'required|exists:countries,id',
            'medicine_company_id' => 'nullable|exists:medicine_companies,id',
        ]);

        $medicine->update([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'product_country_id' => $request->product_country_id,
            'medicine_company_id' => $request->medicine_company_id,
        ]);

        return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
    }

    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->route('medicines.index')->with('success', 'Medicine deleted successfully.');
    }
}