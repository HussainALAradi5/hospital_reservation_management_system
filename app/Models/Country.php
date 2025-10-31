<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
   protected $fillable = ['name', 'official_name', 'code', 'flag_url'];

    public function medicine() {
        return $this->hasMany(Medicine::class, 'product_country_id');
    }
}
