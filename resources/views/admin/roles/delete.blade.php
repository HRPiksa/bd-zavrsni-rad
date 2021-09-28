@extends('layouts.main')

@section('title', 'Brisanje uloge')

@section('content')

<div class="row align-items-center">
    <div class="col-sm-3 border border-danger rounded-pill ml-3 pt-2 pl-4 pr-3 pb-1 bg-light text-danger">
        <h4 style="text-align: left">Brisanje uloge</h4>
    </div>

    <div class="col-sm-3">
        <a href="{{ route('roles.index') }}" class="btn btn-outline-primary"> &lt;&lt;&lt; Povratak</a>
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
    <form action="{{ route('roles.destroy', ['role' => $role->id ]) }}" method="POST">
        @method("DELETE")

        @csrf

        <div class="col-md-6">
            <label for="">Jeste li sigrni da želite obrisati ulogu ?</label>
            <div class="row">
                <div class="col-md-6">
                    <input type="submit" class="btn btn-danger" value="DA">
                </div>
                <div class="col-md-6">
                    <a href="{{ route('roles.index') }}" class="btn btn-warning">NE</a>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection