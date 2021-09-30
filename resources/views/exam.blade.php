@extends('layouts.main')

@section('title', 'Seminarski rad - početna')

@section('content')

<h2>SEMINARSKI RAD – &bdquo;BACK-END DEVELOPER&ldquo;</h2>

<hr>

<div>
    <a href="{{route('home')}}"> &lt;&lt;&lt; Povratak</a>
</div>

<hr>

<br>

<div class="iframe-container">
    <iframe src="{{ asset('files/Seminarski rad_BE DEVELOPER.pdf') }}" width="90%" height="600">
        Ovaj preglednik ne podržava PDF-ove. Molimo preuzmite PDF za pregled: <a
            href="{{ asset('files/Seminarski rad_BE DEVELOPER.pdf') }}">Preuzimanje PDF datoteke</a>
    </iframe>
</div>

@endsection