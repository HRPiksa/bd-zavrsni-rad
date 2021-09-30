@extends('layouts.main5')

@section('title', 'Registracija')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-9 mx-auto">
            <div class="card flex-row my-5 border-0 shadow rounded-3 overflow-hidden">
                <div class="card-img-left d-none d-md-flex">

                </div>

                <div class="card-body p-4 p-sm-5">
                    <h3 class="card-title text-center mb-5 fw-light fs-3">Registracija</h3>

                    <div>
                        @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <form action="{{route('register')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="firstname" placeholder="Ime"
                                        name="firstname" autofocus>
                                    <label for="firstname">Ime</label>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="lastname" placeholder="Prezime"
                                        name="lastname">
                                    <label for="lastname">Prezime</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" placeholder="Korisnik"
                                        name="username">
                            <label for=" username">Korisničko ime</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" placeholder="ime.prezime@primjer.hr"
                                name="email">
                            <label for="email">Email adresa</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" placeholder="Lozinka"
                                name="password">
                            <label for="password">Lozinka</label>
                        </div>

                        <div class="d-grid mb-2">
                            <button class="btn btn-lg btn-primary btn-login fw-bold text-uppercase"
                                type="submit">Registriraj se</button>
                        </div>

                        <a class="d-block text-center mt-2 small" href="{{route('login')}}">Imaš račun? Prijavi se</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection