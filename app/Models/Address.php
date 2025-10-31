<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $fillable = [
        'code',
        'region_id',
        'street',
        'road',
        'building',
        'block',
    ];


    public function region() {
        return $this->belongsTo(Region::class);
    }
}
