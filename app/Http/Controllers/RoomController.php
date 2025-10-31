<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Hospital;
use App\Models\User;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('hospital', 'medicalStaff')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        $staff = User::whereIn('user_type', ['doctor', 'nurse', 'pharmacist'])->get();
        return view('rooms.create', compact('hospitals', 'staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'type' => 'required|in:doctor_season,treatment',
            'capacity' => 'required|integer|min:1',
            'hospital_id' => 'required|exists:hospitals,id',
            'status' => 'required|in:free,occupied,maintenance',
            'medical_staff_id' => 'nullable|exists:users,id',
        ]);

        if ($request->status === 'occupied' && !$request->medical_staff_id) {
            return back()->withErrors(['medical_staff_id' => 'Required when room is occupied.'])->withInput();
        }

        Room::create($request->only([
            'code', 'type', 'capacity', 'hospital_id',
            'status', 'medical_staff_id'
        ]));

        return redirect()->route('rooms.index')->with('success', 'Room created successfully.');
    }

    public function edit(Room $room)
    {
        $hospitals = Hospital::all();
        $staff = User::whereIn('user_type', ['doctor', 'nurse', 'pharmacist'])->get();
        return view('rooms.edit', compact('room', 'hospitals', 'staff'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'code' => 'required|string|max:50',
            'type' => 'required|in:doctor_season,treatment',
            'capacity' => 'required|integer|min:1',
            'hospital_id' => 'required|exists:hospitals,id',
            'status' => 'required|in:free,occupied,maintenance',
            'medical_staff_id' => 'nullable|exists:users,id',
        ]);

        if ($request->status === 'occupied' && !$request->medical_staff_id) {
            return back()->withErrors(['medical_staff_id' => 'Required when room is occupied.'])->withInput();
        }

        $room->update($request->only([
            'code', 'type', 'capacity', 'hospital_id',
            'status', 'medical_staff_id'
        ]));

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}