@extends('layouts.main')

@section('title', 'Uređivane uloge')

@section('content')

<div class="row align-items-center">
    <div class="col-sm-3 border border-warning rounded-pill ml-3 pt-2 pl-3 pr-3 pb-1 bg-light text-warning">
        <h4 style="text-align: left">Uređivanje uloge</h4>
    </div>

    <div class="col-sm-3">
        <a href="{{ route('roles.index') }}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
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
    <form method="POST" action="{{ route('roles.update', ['role' => $role->id]) }}">
        @method('PUT')

        @csrf

        <div class="form-group row align-items-center">
            <label for="name" class="control-label col-sm-2 text-right">Naziv uloge</label>
            <div class="col-sm-7">
                <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}">
            </div>
        </div>

        <div class="form-group row align-items-center">
            <label for="rolesGroup" class="control-label col-sm-2 text-right">Dopuštenja</label>
            <div id="rolesGroup" class="col-sm-7">
                <div class="border border-dark rounded m-1">
                    <label for=""><u>Za korisnike</u></label>
                    <br>
                    <div class="row align-items-center">
                        @foreach ($permissions['users'] as $permission)
                        <div class="form-check col-md-3">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                @if($role->permissions->pluck('id')->contains($permission->id))
                            checked
                            @endif><br>
                            <label for="">{{explode(' ', trim($permission->name))[0]}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border border-dark rounded m-1">
                    <label for=""><u>Za uloge</u></label>
                    <br>
                    <div class="row align-items-center">
                        @foreach ($permissions['roles'] as $permission)
                        <div class="form-check col-md-3">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                @if($role->permissions->pluck('id')->contains($permission->id))
                            checked
                            @endif><br>
                            <label for="">{{explode(' ', trim($permission->name))[0]}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="border border-dark rounded m-1">
                    <label for=""><u>Za stranice</u></label>
                    <br>
                    <div class="row align-items-center">
                        @foreach ($permissions['pages'] as $permission)
                        <div class="form-check col-md-3">
                            <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                                @if($role->permissions->pluck('id')->contains($permission->id))
                            checked
                            @endif><br>
                            <label for="">{{explode(' ', trim($permission->name))[0]}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="form-grouprow align-items-center">
            <div class="col-sm-2 text-right">
                <input type="submit" class="btn btn-success" value="Uredi ulogu" />
            </div>
        </div>
    </form>
</div>

@endsection