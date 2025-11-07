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
        $rooms = Room::with('hospital')->get();
        return view('rooms.index', compact('rooms'));
    }

    public function show($id)
    {
        $room = Room::with('hospital')->findOrFail($id);

        $room->last_sign_ins = json_decode($room->last_sign_ins, true) ?? [];
        $room->sign_outs = json_decode($room->sign_outs, true) ?? [];

        return view('rooms.show', compact('room'));
    }

    public function filter(Request $request)
    {
        $query = Room::with('hospital');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $rooms = $query->get();
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
            'name' => 'required|string|max:255',
            'type' => 'required|in:doctor_season,treatment',
            'status' => 'nullable|in:free,occupied,maintenance',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_staff_ids' => 'nullable|array',
            'medical_staff_ids.*' => 'exists:users,id',
        ]);

        $staffIds = $request->medical_staff_ids ?? [];

        if ($request->status === 'occupied' && empty($staffIds)) {
            return back()->withErrors(['medical_staff_ids' => 'Occupied rooms must have assigned staff.']);
        }

        $signIns = collect($staffIds)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $status = $request->status === 'maintenance'
            ? 'maintenance'
            : (empty($staffIds) ? 'free' : 'occupied');

        Room::create([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'status' => $status,
            'hospital_id' => $request->hospital_id,
            'medical_staff_ids' => $staffIds,
            'last_sign_ins' => $signIns,
            'sign_outs' => [],
        ]);

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
            'name' => 'required|string|max:255',
            'type' => 'required|in:doctor_season,treatment',
            'status' => 'nullable|in:free,occupied,maintenance',
            'hospital_id' => 'required|exists:hospitals,id',
            'medical_staff_ids' => 'nullable|array',
            'medical_staff_ids.*' => 'exists:users,id',
        ]);

        $newStaff = $request->medical_staff_ids ?? [];

        if ($request->status === 'occupied' && empty($newStaff)) {
            return back()->withErrors(['medical_staff_ids' => 'Occupied rooms must have assigned staff.']);
        }

        $oldStaff = $room->medical_staff_ids ?? [];

        $signOuts = collect($oldStaff)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $signIns = collect($newStaff)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $status = $request->status === 'maintenance'
            ? 'maintenance'
            : (empty($newStaff) ? 'free' : 'occupied');

        $room->update([
            'code' => $request->code,
            'name' => $request->name,
            'type' => $request->type,
            'status' => $status,
            'hospital_id' => $request->hospital_id,
            'medical_staff_ids' => $newStaff,
            'last_sign_ins' => $signIns,
            'sign_outs' => array_merge($room->sign_outs ?? [], $signOuts),
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room updated successfully.');
    }

    public function release(Room $room)
    {
        if ($room->type !== 'doctor_season') {
            return back()->withErrors(['type' => 'Only doctor season rooms can be released.']);
        }

        if ($room->status !== 'occupied') {
            return back()->withErrors(['status' => 'Room is not occupied.']);
        }

        if (empty($room->medical_staff_ids)) {
            return back()->withErrors(['medical_staff_ids' => 'No staff assigned to release.']);
        }

        $signOuts = collect($room->medical_staff_ids)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $room->update([
            'status' => 'free',
            'medical_staff_ids' => [],
            'last_sign_ins' => [],
            'sign_outs' => array_merge($room->sign_outs ?? [], $signOuts),
        ]);

        return redirect()->route('rooms.index')->with('success', 'Room released successfully.');
    }

    public function replaceDoctor(Request $request, Room $room)
    {
        if ($room->type !== 'doctor_season') {
            return back()->withErrors(['type' => 'Only doctor season rooms can be reassigned.']);
        }

        $request->validate([
            'new_medical_staff_ids' => 'required|array',
            'new_medical_staff_ids.*' => 'exists:users,id',
        ]);

        $newStaff = $request->new_medical_staff_ids;
        $oldStaff = $room->medical_staff_ids ?? [];

        $signOuts = collect($oldStaff)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $signIns = collect($newStaff)->map(fn($id) => [
            'user_id' => $id,
            'timestamp' => now()->toDateTimeString()
        ])->toArray();

        $room->update([
            'medical_staff_ids' => $newStaff,
            'last_sign_ins' => $signIns,
            'sign_outs' => array_merge($room->sign_outs ?? [], $signOuts),
            'status' => 'occupied',
        ]);

        return redirect()->route('rooms.index')->with('success', 'Doctor(s) replaced successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'Room deleted successfully.');
    }
}