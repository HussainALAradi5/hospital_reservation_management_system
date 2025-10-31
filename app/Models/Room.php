<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'code', 'type', 'capacity', 'hospital_id',
        'status', 'medical_staff_id'
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function medicalStaff()
    {
        return $this->belongsTo(User::class, 'medical_staff_id')
            ->whereNotIn('user_type', ['admin', 'patient']);
    }
}
