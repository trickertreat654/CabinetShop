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
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #4CAF50;
        }
        .details {
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .trips, .images {
            margin-top: 20px;
        }
        .trip, .image {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Pricing Request: Cabinet Job</h1>
        <p>A new cabinet job is ready for pricing. Below are the details:</p>

        <div class="details">
            <h2>Job Details:</h2>
            <p><strong>Title:</strong> {{ $jobTitle }}</p>
            <p><strong>Description:</strong> {{ $jobDescription }}</p>
        </div>

        <div class="details">
            <h2>Customer Details:</h2>
            <p><strong>Name:</strong> {{ $customerName }}</p>
            <p><strong>Email:</strong> {{ $customerEmail }}</p>
        </div>

        @if ($trips->count())
        <div class="trips">
            <h3>Trips:</h3>
            @foreach ($trips as $trip)
                <div class="trip">
                    <p><strong>Trip ID:</strong> {{ $trip->id }}</p>
                    <p><strong>Work Done:</strong> {{ $trip->work_done }}</p>
                    <p><strong>Materials:</strong> {{ $trip->materials }}</p>
                </div>
            @endforeach
        </div>
        @endif

        @if ($images->count())
        <div class="images">
            <h3>Images:</h3>
            @foreach ($images as $image)
            <div class="image">
                <p><strong>Image:</strong> 
                   <a href="{{ asset('storage/' . $image->path) }}">{{ asset('storage/' . $image->path) }}</a>
                </p>
                <img src="{{ asset('storage/' . $image->path) }}" alt="Image">
            </div>
        @endforeach
        </div>
        @endif

        <p>Please review the details and prepare the pricing for this job. Thank you!</p>
    </div>
</body>
</html>
