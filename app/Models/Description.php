<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    protected $fillable = [
    'code', 'name', 'description', 'description_type', 'status', 'date_written',
    'written_by_user_id', 'written_for_user_id', 'hospital_id',
    'medicine_id', 'quantity', 'number_of_days'
];

public function doctor() {
    return $this->belongsTo(User::class, 'written_by_user_id');
}

public function patient() {
    return $this->belongsTo(User::class, 'written_for_user_id');
}

public function hospital() {
    return $this->belongsTo(Hospital::class);
}

public function medicine() {
    return $this->belongsTo(Medicine::class);
}
}
