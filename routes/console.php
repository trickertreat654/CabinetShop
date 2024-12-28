<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use App\Models\Trip;
use App\Mail\TripReminder;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// every day at 5pm it checks to see if any trips are scheduled for the next day and sends an email to the customer

Schedule::call(function () {
    // Get all trips scheduled for tomorrow with necessary relationships
    $trips = Trip::whereDate('scheduled_at', now()->addDay()->toDateString())
        ->get();

        Log::info('trips: ' . $trips);

    if ($trips->count()) {
        // Send one email containing all trips
        Mail::to(['trickertreat654@gmail.com','cabinetsbyjohn@yahoo.com'])->queue(new TripReminder($trips));
    }
})->everyTenMinutes();	
// })->dailyAt('16:45');
