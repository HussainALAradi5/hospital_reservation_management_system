<?php

namespace App\Http\Controllers;

use App\Models\MedicineDescription;
use App\Models\Medicine;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;

class MedicineDescriptionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->user_type === 'patient') {
            // Patient sees only their own medicine descriptions
            $descriptions = MedicineDescription::with(['medicine', 'doctor', 'hospital'])
                ->where('writed_for_user_id', $user->id)
                ->get();
        } else {
            // Others see all
            $descriptions = MedicineDescription::with(['medicine', 'doctor', 'patient', 'hospital'])->get();
        }

        return view('medicine_descriptions.index', compact('descriptions'));
    }

    public function create()
    {
        $this->authorizeCreate();
        $medicines = Medicine::all();
        $hospitals = Hospital::all();
        $patients = User::where('user_type', 'patient')->get();
        return view('medicine_descriptions.create', compact('medicines', 'hospitals', 'patients'));
    }

    public function store(Request $request)
    {
        $this->authorizeCreate();

        $request->validate([
            'code' => 'required|string|max:50|unique:medicine_descriptions',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'medicine_id' => 'required|exists:medicines,id',
            'writed_for_user_id' => 'required|exists:users,id',
            'number_of_days' => 'required|integer|min:1',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        MedicineDescription::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'medicine_id' => $request->medicine_id,
            'writen_by_user_id' => auth()->id(),
            'writed_for_user_id' => $request->writed_for_user_id,
            'number_of_days' => $request->number_of_days,
            'hospital_id' => $request->hospital_id,
        ]);

        return redirect()->route('medicine_descriptions.index')->with('success', 'Medicine description created.');
    }

    public function show(MedicineDescription $medicineDescription)
    {
        $user = auth()->user();

        if ($user->user_type === 'patient' && $medicineDescription->writed_for_user_id !== $user->id) {
            abort(403, 'You can only view your own medicine descriptions.');
        }

        return view('medicine_descriptions.show', compact('medicineDescription'));
    }

    public function edit(MedicineDescription $medicineDescription)
    {
        $this->authorizeEdit();
        $medicines = Medicine::all();
        $hospitals = Hospital::all();
        $patients = User::where('user_type', 'patient')->get();
        return view('medicine_descriptions.edit', compact('medicineDescription', 'medicines', 'hospitals', 'patients'));
    }

    public function update(Request $request, MedicineDescription $medicineDescription)
    {
        $this->authorizeEdit();

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'medicine_id' => 'required|exists:medicines,id',
            'writed_for_user_id' => 'required|exists:users,id',
            'number_of_days' => 'required|integer|min:1',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $medicineDescription->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'medicine_id' => $request->medicine_id,
            'writed_for_user_id' => $request->writed_for_user_id,
            'number_of_days' => $request->number_of_days,
            'hospital_id' => $request->hospital_id,
        ]);

        return redirect()->route('medicine_descriptions.index')->with('success', 'Medicine description updated.');
    }

    // Access control helpers
    private function authorizeCreate()
    {
        if (!in_array(auth()->user()->user_type, ['doctor', 'admin'])) {
            abort(403, 'Only doctors and admins can create medicine descriptions.');
        }
    }

    private function authorizeEdit()
    {
        if (!in_array(auth()->user()->user_type, ['doctor', 'admin'])) {
            abort(403, 'Only doctors and admins can edit medicine descriptions.');
        }
    }
}