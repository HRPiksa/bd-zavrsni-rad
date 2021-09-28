@extends('layouts.main')

@section('title', 'Seminarski rad - početna')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="jumbotron jumbotron-fluid bg-dark">

            <div class="jumbotron-background">
                {{-- <img src="https://placeimg.com/2000/1000/nature" class="blur "> --}}
                <img src="/storage/images/backgrounds/home.jpg" class="blur ">
            </div>

            <div class="container text-white">

                <h1 class="display-4">BACK-END DEVELOPER</h1>

                <br>

                <p class="lead">Dobro došli na administracijsko sučelje seminarskog rada modula<br>&bdquo;BACK-END
                    DEVELOPER&ldquo; .</p>

                <br>
                <hr class="my-4">
                <br>

                <a class="btn btn-primary btn-lg" href="{{route('exam')}}" role="button">Vidi zadatak</a>
            </div>
        </div>
    </div>
</div>

@endsection