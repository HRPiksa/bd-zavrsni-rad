@extends('layouts.main')

@section('title', 'Uređivanje korisnika')

@section('content')

<div class="row align-items-center">
    <div class="col-sm-3 border border-warning rounded-pill ml-3 pt-2 pl-3 pr-3 pb-1 bg-light text-warning">
        <h4 style="text-align: left">Uređivanje korisnika</h4>
    </div>

    <div class="col-sm-3">
        <a href="{{url(session()->get('users_data_url'))}}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
    </div>
</div>

<hr>

<div>
    @if (!$errors->isEmpty())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $message)
            <li>{{$message}}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div>
    <form action="{{route('user-update', ['user' => $user->id])}}" method="POST">
        @csrf

        <div class="form-group row align-items-center">
            <label for="firstname" class="control-label col-sm-3 text-right">Ime</label>
            <div class="col-sm-5">
                <input type="text" id="firstname" name="firstname" class="form-control" value="{{$user->firstname}}">
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="lastname" class="control-label col-sm-3 text-right">Prezime</label>
            <div class="col-sm-5">
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{$user->lastname}}">
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="email" class="control-label col-sm-3 text-right">Email adresa</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label for="roles" class="control-label col-sm-3 text-right">Uloge</label>
            <div id="roles" class="col-sm-3">
                @foreach ($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                        @if($user->roles->pluck('id')->contains($role->id)) checked @endif
                    @if ($user->roles->pluck('name')->contains('admin'))
                    @if ($role->name == 'admin') hidden @endif
                    @endif
                    >
                    <label>{{$role->name}}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-group row align-items-center">
            <div class="col-sm-3 text-right">
                <input type="submit" class="btn btn-success" value="Uredi korisnika">
            </div>
        </div>
    </form>
</div>
@endsection