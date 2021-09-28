@extends('layouts.main')

@section('title', 'Kreiranje korisnika')

@section('content')


<div class="row align-items-center">
    <div class="col-sm-3 border border-success rounded-pill ml-3 pt-2 pl-3 pr-3 pb-1 bg-light text-success">
        <h4 style="text-align: left">Kreiranje korisnika</h4>
    </div>

    <div class="col-sm-3">
        <a href="{{ route('user-show') }}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
    </div>
</div>

<hr>

<div>
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div>
    <form action="{{ route('user-store') }}" method="post">
        @csrf

        <div class="form-group row align-items-center">
            <label for="firstname" class="control-label col-sm-3 text-right">Ime</label>
            <div class="col-sm-5">
                <input type="text" id="firstname" name="firstname" class="form-control"
                    value="{{ old('firstname') }}" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="lastname" class="control-label col-sm-3 text-right">Prezime</label>
            <div class="col-sm-5">
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{ old('lastname') }}" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="email" class="control-label col-sm-3 text-right">Email</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="username" class="control-label col-sm-3 text-right">Korisničko ime</label>
            <div class="col-sm-5">
                <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="password" class="control-label col-sm-3 text-right">Lozinka</label>
            <div class="col-sm-5">
                <input type="password" id="password" name="password" class="form-control" />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="roles" class="control-label col-sm-3 text-right">Uloge</label>
            <div id="roles" class="col-sm-3">
                @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value={{ $role->id }}>
                    <label>{{ $role->name }}</label>
                </div>
                @endforeach
            </div>
        </div>

        <div class="form-grouprow align-items-center">
            <div class="col-sm-3 text-right">
                <input type="submit" class="btn btn-success" value="Kreiraj korisnika" />
            </div>
        </div>
    </form>
</div>

@endsection