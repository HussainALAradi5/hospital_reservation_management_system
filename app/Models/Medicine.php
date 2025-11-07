<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = ['code', 'name', 'description', 'quantity', 'product_country_id','medicine_company_id'
];

    public function country() {
        return $this->belongsTo(Country::class, 'product_country_id');
    }

    public function company() {
        return $this->belongsTo(MedicineCompany::class);
    }

}
