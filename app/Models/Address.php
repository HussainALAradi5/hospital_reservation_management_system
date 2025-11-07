<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
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
