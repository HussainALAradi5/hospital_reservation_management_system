<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = ['code', 'name', 'description', 'quantity', 'product_country_id'];

    public function country() {
        return $this->belongsTo(Country::class, 'product_country_id');
    }
}
