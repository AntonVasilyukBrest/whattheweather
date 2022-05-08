<!-- resources/views/child.blade.php -->

@extends('index')

@section('title', 'Weather in '.$city)

@section('forecast')
    <div class="row mt-5">
        <div class="col-6 card bg-dark text-white text-center">
        @if (!empty($forecast))
            <p>Current weather temperature is: {{ $forecast['current']['temp'] }} °C</p>
            <p>Feels like: {{ $forecast['current']['feels_like'] }} °C</p>
            <p>Sunrise: at {{ @date('Y-m-d H:i:s', $forecast['current']['sunrise']) }}</p>
            <p>Sunset: at {{ @date('Y-m-d H:i:s', $forecast['current']['sunset']) }}</p>
            <p>Pressure: {{ $forecast['current']['pressure'] }}</p>
            <p>Humidity: {{ $forecast['current']['humidity'] }}%</p>
            <p>Clouds: {{ $forecast['current']['clouds'] }}%</p>
            <p>Wind speed: {{ $forecast['current']['wind_speed'] }}m/s</p>
        </div>
        <div id="carouselHourly" class="carousel slide carousel-fade text-center col-6" data-bs-ride="carousel">
            <div class="carousel-inner mh-100">
                @foreach (@array_slice($forecast['hourly'],0,12) as $key => $hour)
                    <div class="carousel-item card bg-dark text-white @if ($key === 1) active @endif">
                        <p>Temperature by hours: {{ @date('Y-m-d H:i', $hour['dt']) }}</p>
                        <p>&nbsp;</p>
                        <p>Temperature is: {{ $hour['temp'] }} °C</p>
                        <p>Feels like: {{ $hour['feels_like'] }} °C</p>
                        <p>Pressure: {{ $hour['pressure'] }}</p>
                        <p>Humidity: {{ $hour['humidity'] }}%</p>
                        <p>Clouds: {{ $hour['clouds'] }}%</p>
                        <p>Wind speed: {{ $hour['wind_speed'] }}m/s</p>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselHourly" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselHourly" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="row mt-5">
            <div id="carouselDaily" class="carousel slide carousel-fade text-center offset-3 col-6" data-bs-ride="carousel">
                <div class="carousel-inner mh-100">
                    @foreach ($forecast['daily'] as $key => $day)
                        <div class="carousel-item card bg-dark text-white @if ($key === 1) active @endif">
                            <p>{{ @date('Y-m-d', $day['dt']) }}</p>
                            <p>Day Temperature is: {{ $day['temp']['day'] }} °C</p>
                            <p>Night Temperature is: {{ $day['temp']['night'] }} °C</p>
                            <p>Feels like: {{ $day['feels_like']['day'] }} °C</p>
                            <p>Pressure: {{ $day['pressure'] }}</p>
                            <p>Humidity: {{ $day['humidity'] }}%</p>
                            <p>Clouds: {{ $day['clouds'] }}%</p>
                            <p>Wind speed: {{ $day['wind_speed'] }}m/s</p>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselDaily" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselDaily" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        @else
            <p>{{ $error }}</p>
        @endif
    </div>
    <script>
        var dailyCarousel = document.querySelector('#carouselDaily')
        var carouselD = new bootstrap.Carousel(dailyCarousel)
        var hourlyCarousel = document.querySelector('#carouselHourly')
        var carouselH = new bootstrap.Carousel(hourlyCarousel)
    </script>
@endsection

{{--@section('content')--}}
{{--    <p>This is my body content.</p>--}}
{{--@endsection--}}
