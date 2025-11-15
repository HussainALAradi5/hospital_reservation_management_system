<?php

namespace App\Http\Controllers;

use App\Models\Description;
use App\Models\Medicine;
use App\Models\User;
use App\Models\Hospital;
use Illuminate\Http\Request;

class DescriptionController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $descriptions = Description::with(['medicine', 'doctor', 'patient', 'hospital'])
            ->medicine()
            ->when($user->user_type === 'patient', fn ($q) =>
                $q->where('written_for_user_id', $user->id)
            )
            ->get();

        return view('descriptions.index', compact('descriptions'));
    }

    public function create()
    {
        $medicines = Medicine::all();
        $patients = User::where('user_type', 'patient')->get();
        $hospitals = Hospital::all();

        return view('descriptions.create', compact('medicines', 'patients', 'hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:descriptions',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'number_of_days' => 'required|integer|min:1',
            'medicine_id' => 'required|exists:medicines,id',
            'written_for_user_id' => 'required|exists:users,id',
            'hospital_id' => 'required|exists:hospitals,id',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        Description::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'description_type' => 'medicine',
            'status' => $request->status,
            'date_written' => now(),
            'written_by_user_id' => auth()->id(),
            'written_for_user_id' => $request->written_for_user_id,
            'hospital_id' => $request->hospital_id,
            'medicine_id' => $request->medicine_id,
            'quantity' => $request->quantity,
            'number_of_days' => $request->number_of_days,
        ]);

        return redirect()->route('descriptions.index')->with('success', 'Description saved.');
    }

    public function show(Description $description)
    {
        $user = auth()->user();

        if ($user->user_type === 'patient' && $description->written_for_user_id !== $user->id) {
            abort(403, 'You can only view your own descriptions.');
        }

        $description->load(['medicine', 'doctor', 'patient', 'hospital']);

        return view('descriptions.show', compact('description'));
    }

    public function edit(Description $description)
    {
        $medicines = Medicine::all();
        $patients = User::where('user_type', 'patient')->get();
        $hospitals = Hospital::all();

        return view('descriptions.edit', compact('description', 'medicines', 'patients', 'hospitals'));
    }

    public function update(Request $request, Description $description)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'quantity' => 'required|integer|min:1',
            'number_of_days' => 'required|integer|min:1',
            'medicine_id' => 'required|exists:medicines,id',
            'written_for_user_id' => 'required|exists:users,id',
            'hospital_id' => 'required|exists:hospitals,id',
            'status' => 'required|in:pending,in_progress,done',
        ]);

        $description->update([
            'name' => $request->name,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'number_of_days' => $request->number_of_days,
            'medicine_id' => $request->medicine_id,
            'written_for_user_id' => $request->written_for_user_id,
            'hospital_id' => $request->hospital_id,
            'status' => $request->status,
        ]);

        return redirect()->route('descriptions.index')->with('success', 'Description updated.');
    }
}