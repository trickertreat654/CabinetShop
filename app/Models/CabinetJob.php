<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CabinetJob extends Model
{
    /** @use HasFactory<\Database\Factories\CabinetJobFactory> */
    use HasFactory;

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    
}
