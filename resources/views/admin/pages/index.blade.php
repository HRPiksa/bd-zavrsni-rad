@extends('layouts.main')

@section('title', 'Popis svih stranica')

@section('content')

<div class="card">
    <div class="card-header">
        Seminarski rad - &bdquo;BACK-END DEVELOPER&ldquo; administracijsko sučelje
    </div>

    <div class="card-body">
        <div class="container-fluid">
            <div class="align-items-center">
                <div class="float-left border border-primary rounded-pill pt-2 pl-3 pr-3 pb-1 bg-light text-primary">
                    <h4 style="text-align: left">Popis svih stranica</h4>
                </div>

                @can('create-pages', User::class)
                <div class="float-right">
                    <a href="{{route('pages.create')}}" class="btn btn-success">Dodaj novu stranicu</a>
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
                    <tr>
                        {{-- <th scope="col">#</th> --}}
                        <th scope="col">Naslov</th>
                        <th scope="col">URL</th>
                        <th scope="col">Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pages as $page)
                    <tr>
                        {{-- <td>{{ $page->id }}</td> --}}
                        <td>{!! $page->present()->paddedTitle !!}</td>
                        <td>{{ $page->url }}</td>

                        @canany(['edit-pages', 'delete-pages'], User::class)
                        <td>
                            @can('edit-pages', User::class)
                            <a href="{{route('pages.edit', ['page' => $page->id])}}" class="btn btn-warning">Uredi</a>
                            @endcan
                            @can('delete-pages', User::class)
                            <a href="{{route('pages-delete', ['page' => $page->id])}}" class="btn btn-danger">Obriši</a>
                            @endcan
                        </td>
                        @endcanany
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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