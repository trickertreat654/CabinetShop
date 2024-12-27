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

    protected static function booted()
    {
        static::updated(function ($cabinetJob) {
            \Log::info('is_completed current: ' . $cabinetJob->is_completed);
            \Log::info('is_completed original: ' . $cabinetJob->getOriginal('is_completed'));
    
            if ($cabinetJob->is_completed && $cabinetJob->getOriginal('is_completed') == false) {
                \Mail::to('trickertreat654@gmail.com')->send(new \App\Mail\CabinetJobCompleted($cabinetJob));
            }
        });
    }

    
}
