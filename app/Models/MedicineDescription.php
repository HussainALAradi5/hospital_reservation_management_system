<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineDescription extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'quantity',
        'medicine_id', 'writen_by_user_id', 'writed_for_user_id',
        'number_of_days', 'hospital_id'
    ];

    public function medicine() {
        return $this->belongsTo(Medicine::class);
    }

    public function doctor() {
        return $this->belongsTo(User::class, 'writen_by_user_id');
    }

    public function patient() {
        return $this->belongsTo(User::class, 'writed_for_user_id');
    }

    public function hospital() {
        return $this->belongsTo(Hospital::class);
    }

}
