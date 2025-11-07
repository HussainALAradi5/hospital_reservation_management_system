<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
     use HasFactory;
    protected $fillable = [
        'code', 'name', 'type', 'status', 'hospital_id',
        'medical_staff_ids', 'last_sign_in_user_ids', 'sign_out_user_ids'
    ];

    protected $casts = [
        'medical_staff_ids' => 'array',
        'last_sign_in_user_ids' => 'array',
        'sign_out_user_ids' => 'array',
    ];

    public function hospital()
    {
        return $this->belongsTo(Hospital::class);
    }

    public function medicalStaff()
    {
        return User::whereIn('id', $this->medical_staff_ids ?? [])->get();
    }

    public function lastSignInUsers()
    {
        return User::whereIn('id', $this->last_sign_in_user_ids ?? [])->get();
    }

    public function signOutUsers()
    {
        return User::whereIn('id', $this->sign_out_user_ids ?? [])->get();
    }
}