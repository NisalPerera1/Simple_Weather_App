<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f9fc;
            color: #333;
        }
        .weather-card {
            background: linear-gradient(135deg, #74ebd5 0%, #ACB6E5 100%);
            color: #fff;
        }
        .weather-card h3 {
            font-size: 24px;
            margin-bottom: 15px;
        }
        .weather-card p {
            margin: 0;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Weather App</h1>

    <form action="{{ route('get.weather') }}" method="POST" class="mb-4">
        @csrf
        <div class="mb-3">
            <input type="text" name="city" class="form-control" placeholder="Enter city" value="{{ $city ?? '' }}" required>
        </div>
        <div class="mb-3">
            <input type="date" name="date" class="form-control" value="{{ $date ?? '' }}" required>
        </div>
        <button class="btn btn-primary" type="submit">Get Weather</button>
    </form>

    @if(isset($selectedDayForecast))
        <div class="card weather-card mb-4">
            <div class="card-body text-center">
                <h3>Weather in {{ $city }} on {{ \Carbon\Carbon::parse($date)->format('l, F j, Y') }}</h3>
                <p>Temperature: {{ $selectedDayForecast['temp'] ?? 'N/A' }} °C</p>
                <p>Rain Forecast: {{ $selectedDayForecast['precip'] ?? 'N/A' }} mm</p>
            </div>
        </div>
    @endif

    @if(isset($error))
        <div class="alert alert-danger mt-4">
            {{ $error }}
        </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
