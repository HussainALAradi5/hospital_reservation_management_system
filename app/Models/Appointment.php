<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment  extends Model
{
    protected $fillable = [
        'code', 'hospital_id', 'patient_id', 'doctor_id', 'room_id',
        'appointment_date', 'appointment_time', 'status'
    ];

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

    public function patient() {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function room() {
        return $this->belongsTo(Room::class);
    }

}
