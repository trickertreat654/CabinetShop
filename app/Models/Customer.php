<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\CustomerFactory> */
    use HasFactory;


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function address()
    {
        return $this->hasOne(Address::class);
    }

    public function cabinetJobs()
    {
        return $this->hasMany(CabinetJob::class);
    }
}
