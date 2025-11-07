<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    use HasFactory;
    protected $fillable = [
        'code', 'name', 'region_id', 'address_id',
        'open_at', 'close_at', 'days_of_work',
        'medical_staff_ids', 'room_ids'
    ];

    public function region() { return $this->belongsTo(Region::class); }
    public function address() { return $this->belongsTo(Address::class); }
    public function rooms() { return $this->hasMany(Room::class); }
    public function staff() { return $this->hasMany(User::class); }
}
