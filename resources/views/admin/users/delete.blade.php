@extends('layouts.main')

@section('title', 'Brisanje korisnika')

@section('content')

<div class="row align-items-center">
    <div class="col-sm-3 border border-danger rounded-pill ml-3 pt-2 pl-4 pr-3 pb-1 bg-light text-danger">
        <h4 style="text-align: left">Brisanje korisnika</h4>
    </div>

    <div class="col-sm-3">
        <a href="{{url(session()->get('users_data_url'))}}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
    </div>
</div>

<hr>

<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div>
    <form action="{{route('user-destroy', ['user' => $user->id])}}" method="POST">
        @csrf

        <div class="col-md-6">
            <label for="">Jeste li sigurni da želite obrisati korisnika ?</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" class="btn btn-danger" value="DA">
                </div>
                <div class="col-md-6">
                    <a href="{{url(session()->get('users_data_url'))}}" class="btn btn-warning">NE</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection