<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

      protected $table = 'cars';

        protected $fillable = [

        'brand',
        'vin_code',
        'license_plate',
        'problem',
        'clint_id',
        'image'
    ];

    public function clint()
    {
        return $this->belongsTo(Clint::class,'clint_id','id');
    }

}
