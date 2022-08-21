<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clint extends Model
{
    use HasFactory;

    protected $table = 'clints';

        protected $fillable = [

        'id',   
        'name',
        'phone_number'
    ];

     public function cars()
    {
        return $this->hasMany(Car::class);
    }
    
}
