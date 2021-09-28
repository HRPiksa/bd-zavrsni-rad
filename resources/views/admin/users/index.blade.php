@extends('layouts.main')

@section('title', 'Popis svih korisnika')

@section('content')

<div class="card">
    <div class="card-header">
        Seminarski rad - &bdquo;BACK-END DEVELOPER&ldquo; administracijsko sučelje
    </div>

    <div class="card-body">
        <div class="align-items-center">
            <div class="float-left border border-primary rounded-pill pt-2 pl-3 pr-3 pb-1 bg-light text-primary">
                <h4 style="text-align: left">Popis svih korisnika </h4>
            </div>

            @can('create-users', User::class)
            <div class="float-right">
                <a href="{{ route('user-create') }}" class="btn btn-success">Dodaj novog korisnika</a>
            </div>
            @endcan
        </div>

        <br><br>
        <hr>

        <div class="align-items-center">
            <div class="float-left">
                <form action="{{ route('user-show') }}" method="GET">
                    <label for="selPerPage">Prikaži&nbsp; </label>
                    <select name="per_page" id="selPerPage" onchange="this.form.submit()">
                        @foreach($valuesPerPage as $perPage)
                        <option value="{{$perPage}}" {{ $all_users->perPage()  == $perPage ? 'selected' : '' }}>
                            {{$perPage}}
                        </option>
                        @endforeach
                    </select>
                    <label for=""> &nbsp;podataka.</label>
                </form>
            </div>

            <div class="mx-auto float-right">
                <div class="">
                    <form action="{{ route('user-show') }}" method="GET" role="search">

                        <div class="input-group">
                            <span class="input-group-btn mr-5 mt-1">
                                <button class="btn btn-info" type="submit" title="Pretraži korisnike">
                                    <span class="fas fa-search"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control mr-2" name="term" placeholder="Pretraži korisnike"
                                id="term">
                            <a href="{{ route('user-show') }}" class=" mt-1">
                                <span class="input-group-btn">
                                    <button class="btn btn-secondary" type="button" title="Osvježi stranicu">
                                        <span class="fas fa-sync-alt"></span>
                                    </button>
                                </span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
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

        <table class="table" id="userTable">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">@sortablelink('firstname', 'Ime i prezime')</th>
                    <th scope="col">@sortablelink('username', 'Korisnik')</th>
                    <th scope="col">@sortablelink('email', 'Email')</th>
                    <th scope="col">Uloga</th>
                    <th scope="col">@sortablelink('last_login_at', 'Zadnja prijava')</th>
                    <th scope="col">Akcija</th>
                </tr>
            </thead>
            <tbody>
                @if ($all_users->count() == 0)
                <tr>
                    <td colspan="5">Nema korisnika za prikaz.</td>
                </tr>
                @endif

                @foreach ($all_users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    @can('manage-users', User::class)
                    <td>
                        <a href="#" class="btnSelect">{{$user->firstname . ' ' . $user->lastname}}</a>
                    </td>
                    @else
                    <td>{{$user->firstname . ' ' . $user->lastname}}</td>
                    @endcan
                    <td>{{$user->username}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        {{implode(', ', $user->roles()->pluck('name')->toArray())}}
                    </td>
                    @if($user->last_login_at != null)
                    <td>{{\Carbon\Carbon::parse($user->last_login_at)->diffForHumans()}}</td>
                    @else
                    <td> </td>
                    @endif
                    @canany(['manage-users', 'edit-users', 'delete-users'], User::class)
                    <td>
                        @can('manage-users', User::class)
                        <a href="{{route('user-view', ['user' => $user->id])}}" class="btn btn-info">Vidi</a>
                        @endcan
                        @can('edit-users', User::class)
                        <a href="{{route('user-edit', ['user' => $user->id])}}" class="btn btn-warning">Uredi</a>
                        @endcan
                        @can('delete-users', User::class)
                        <a href="{{route('user-delete', ['user' => $user->id])}}" class="btn btn-danger">Obriši</a>
                        @endcan
                    </td>
                    @endcanany
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="pull-left ml-3">
                Prikaz {{($all_users->currentPage()-1)* $all_users->perPage()+($all_users->total() ? 1:0)}} do
                {{($all_users->currentPage()-1)*$all_users->perPage()+count($all_users)}} od
                {{$all_users->total()}}
            </div>

            <div class="mx-auto">
                {{ $all_users->links('vendor.pagination.custom', ['totalPage' => $totalPage]) }}
            </div>
        </div>

    </div>
</div>

<!-- Start View User Modal -->
<div class="modal" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color:#FFFFF0">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Pregled korisnika</h4>
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                <button type="button" class="viewUserModelClose" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" id="viewForm">
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="viewUserModalBody">

                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary viewUserModelClose"
                        data-dismiss="modal">Zatvori</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End View User Modal -->

@endsection

@section('script')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
    $('.viewUserModelClose').on('click', function(){
        $('#viewUserModal').hide();
    });

    $("#userTable").on('click','.btnSelect',function(e){
        //e.preventDefault();
        var currentRow = $(this).closest("tr");
        id = currentRow.find("td:eq(0)").text();

        $.ajax({
            url: '{{url("admin/user/viewModal")}}/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(result) {
                //alert(result.html);
                $('#viewUserModalBody').html(result.html);
                $('#viewUserModal').show();
            }
        });
    });

    setTimeout(function(){
        $("div.alert").remove();
    }, 3000 );
});
</script>

@endsection