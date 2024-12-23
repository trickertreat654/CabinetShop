<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Trip extends Model
{
    /** @use HasFactory<\Database\Factories\TripFactory> */
    use HasFactory;

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function cabinetJob()
    {
        return $this->belongsTo(CabinetJob::class);
    } 
}
