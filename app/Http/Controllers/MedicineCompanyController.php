<?php
namespace App\Http\Controllers;

use App\Models\MedicineCompany;
use App\Models\Country;
use App\Models\Address;
use Illuminate\Http\Request;

class MedicineCompanyController extends Controller
{
    public function index()
    {
        $companies = MedicineCompany::with(['country', 'address'])->get();
        return view('medicine_companies.index', compact('companies'));
    }

    public function create()
    {
        $countries = Country::all();
        $addresses = Address::all();
        return view('medicine_companies.create', compact('countries', 'addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:medicine_companies,code',
            'country_id' => 'required|exists:countries,id',
            'address_id' => 'required|exists:addresses,id',
        ]);

        MedicineCompany::create($request->all());

        return redirect()->route('medicine_companies.index')->with('success', 'Company added successfully.');
    }

    public function show(MedicineCompany $medicineCompany)
    {
        return view('medicine_companies.show', compact('medicineCompany'));
    }

    public function edit(MedicineCompany $medicineCompany)
    {
        $countries = Country::all();
        $addresses = Address::all();
        return view('medicine_companies.edit', compact('medicineCompany', 'countries', 'addresses'));
    }

    public function update(Request $request, MedicineCompany $medicineCompany)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:medicine_companies,code,' . $medicineCompany->id,
            'country_id' => 'required|exists:countries,id',
            'address_id' => 'required|exists:addresses,id',
        ]);

        $medicineCompany->update($request->all());

        return redirect()->route('medicine_companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(MedicineCompany $medicineCompany)
    {
        $medicineCompany->delete();
        return redirect()->route('medicine_companies.index')->with('success', 'Company deleted successfully.');
    }
}