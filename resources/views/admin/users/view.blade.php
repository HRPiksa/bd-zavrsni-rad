@extends('layouts.main')

@section('title', 'Kreiranje korisnika')

@section('content')


<div class="row align-items-center">
    <div class="col-sm-3 border border-info rounded-pill ml-3 pt-2 pl-4 pr-3 pb-1 bg-light text-info">
        <h4 style="text-align: left">Pregled korisnika</h4>
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
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

<div>
    <form action="" method="post">
        <div class="form-group row align-items-center">
            <label for="firstname" class="control-label col-sm-3 text-right">Ime</label>
            <div class="col-sm-5">
                <input type="text" id="firstname" name="firstname" class="form-control" value="{{$user->firstname}}"
                    readonly />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="lastname" class="control-label col-sm-3 text-right">Prezime</label>
            <div class="col-sm-5">
                <input type="text" id="lastname" name="lastname" class="form-control" value="{{$user->lastname}}"
                    readonly />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="email" class="control-label col-sm-3 text-right">Email</label>
            <div class="col-sm-5">
                <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}" readonly />
            </div>
        </div>
        <div class="form-group row align-items-center">
            <label for="username" class="control-label col-sm-3 text-right">Korisničko ime</label>
            <div class="col-sm-5">
                <input type="text" id="username" name="username" class="form-control" value="{{$user->username}}"
                    readonly />
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label for="roles" class="control-label col-sm-3 text-right">Uloge</label>
            <div id="roles" class="col-sm-3">
                @foreach ($roles as $role)
                <div class="form-check">
                    <div>
                        <input type="checkbox" name="roles[]" value="{{$role->id}}" readonly
                            @if($user->roles->pluck('id')->contains($role->id))
                        checked
                        @endif
                        @if ($user->roles->pluck('name')->contains('admin'))
                        @if ($role->name == 'admin')
                        hidden
                        @endif
                        @endif
                        >
                        <label>{{$role->name}}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </form>
</div>

@endsection