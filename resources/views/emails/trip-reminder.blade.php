<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #4CAF50;
        }
        .trip {
            margin-top: 20px;
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .trip:last-child {
            border-bottom: none;
        }
        .trip-header {
            font-size: 1.2em;
            font-weight: bold;
        }
        .materials {
            margin-top: 10px;
        }
        a {
            color: #007BFF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Trip Reminder for {{ now()->addDay()->toFormattedDateString() }}</h1>
        <p>Here are the trips scheduled for tomorrow:</p>

        @foreach ($trips as $trip)
    <div class="trip">
        <div class="trip-header">
            Trip #{{ $trip->id }}: 
            {{ optional(optional(optional($trip->cabinetJob)->customer))->account ?? 'No Account Information' }}
        </div>
        <p><strong>Address:</strong> 
            @if(optional(optional($trip->cabinetJob)->customer)->address)
                <a href="https://maps.google.com/?q={{ urlencode(optional($trip->cabinetJob->customer->address)->street . ', ' . optional($trip->cabinetJob->customer->address)->city . ', ' . optional($trip->cabinetJob->customer->address)->state . ' ' . optional($trip->cabinetJob->customer->address)->zip) }}">
                    {{ optional($trip->cabinetJob->customer->address)->street }},
                    {{ optional($trip->cabinetJob->customer->address)->city }},
                    {{ optional($trip->cabinetJob->customer->address)->state }}
                    {{ optional($trip->cabinetJob->customer->address)->zip }}
                </a>
            @else
                No Address Information
            @endif
        </p>
        <p><strong>Materials:</strong></p>
        <p>{{ $trip->materials ?? 'No materials listed' }}</p>
    </div>
@endforeach


        <p>Thank you!</p>
    </div>
</body>
</html>
