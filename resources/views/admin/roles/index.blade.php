@extends('layouts.main')

@section('title', 'Popis svih uloga')

@section('content')

<div class="card">
    <div class="card-header">
        Seminarski rad - &bdquo;BACK-END DEVELOPER&ldquo; administracijsko sučelje
    </div>

    <div class="card-body">
        <div class="align-items-center">
            <div class="float-left border border-primary rounded-pill pt-2 pl-3 pr-3 pb-1 bg-light text-primary">
                <h4 style="text-align: left">Popis svih uloga </h4>
            </div>

            @can('create-roles', User::class)
            <div class="float-right">
                <a href="{{route('roles.create')}}" class="btn btn-success">Dodaj novu ulogu</a>
            </div>
            @endcan
        </div>

        <br><br>

        <div class="text-left p-2">
            @if (session('status'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                {{ session('status')}}
            </div>
            @endif
        </div>

        <table class="table">
            <thead>
                <tr class="d-flex">
                    {{-- <th class="col-1">#</th> --}}
                    <th class="col-2">Naziv</th>
                    <th class="col-7">Dopuštenje</th>
                    <th class="col-3">Akcija</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                <tr class="d-flex">
                    {{-- <td class="col-1">{{ $role->id }}</td> --}}
                    <td class="col-2">{{ $role->name }}</td>
                    <td class="col-7">
                        {{ implode(', ', $role->permissions()->pluck('name')->toArray()) }}
                    </td>

                    @canany(['edit-roles', 'delete-roles'], User::class)
                    <td class="col-3">
                        @can('edit-roles', User::class)
                        <a href="{{route('roles.edit', ['role' => $role->id])}}" class="btn btn-warning">Uredi</a>
                        @endcan
                        @can('delete-roles', User::class)
                        <a href="{{route('roles-delete', ['role' => $role->id])}}" class="btn btn-danger">Obriši</a>
                        @endcan
                    </td>
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection


@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    setTimeout(function(){
        $("div.alert").remove();
    }, 3000 );
});
</script>

@endsection