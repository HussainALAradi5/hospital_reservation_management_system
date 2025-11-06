<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicineCompany extends Model
{
    protected $fillable = ['name', 'code', 'country_id', 'address_id'];

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function address() {
        return $this->belongsTo(Address::class);
    }

    public function medicines() {
        return $this->hasMany(Medicine::class);
    }

}
