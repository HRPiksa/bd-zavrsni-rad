@extends('layouts.main5')

@section('title', 'Prijava')

@section('content')

<div class="container-fluid ps-md-0">
    <div class="row g-0">
        <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image"></div>
        <div class="col-md-8 col-lg-6">
            <div class="login d-flex align-items-center py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-9 col-lg-8 mx-auto">
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

                            <h3 class="login-heading mb-4">Dobro došli !</h3>

                            <!-- Sign In Form -->
                            <form action="{{route('login')}}" method="post">
                                @csrf

                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="ime.prezime@primjer.hr"
                                        oninvalid="this.setCustomValidity('Unesite ispravnu email adresu')"
                                        oninput="setCustomValidity('')" required autofocus>
                                    <label for="email">Email adresa</label>
                                </div>
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Lozinka"
                                        oninvalid="this.setCustomValidity('Unesite ispravnu lozinku')"
                                        oninput="setCustomValidity('')" required>
                                    <label for="password">Lozinka</label>
                                </div>

                                <div class="d-grid">
                                    <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mb-2"
                                        type="submit">Prijavi se</button>
                                </div>

                                <a class="d-block text-center mt-2 small" href="{{route('register')}}">Nisi registriran?
                                    Registriraj se</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection