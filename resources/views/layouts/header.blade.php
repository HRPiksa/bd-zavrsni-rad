<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="mr-auto">
                <ul class="navbar-nav">
                    <li>
                        <a class="nav-item nav-link" href="{{route('home')}}">Početna</a>
                    </li>

                    @if (Auth::user())
                    @can('manage-users', User::class)
                    <li>
                        <a class="nav-item nav-link" href="{{route('user-show')}}">Korisnici</a>
                    </li>
                    @endcan
                    @can('manage-roles', User::class)
                    <li>
                        <a class="nav-item nav-link" href="{{route('roles.index')}}">Uloge</a>
                    </li>
                    @endcan
                    @can('manage-pages', User::class)
                    <li>
                        <a class="nav-item nav-link" href="{{route('pages.index')}}">Stranice</a>
                    </li>
                    @endcan
                    @endif
                </ul>
            </div>

            <div>
                <ul class="navbar-nav navbar-right">
                    @if (Auth::user())
                    {{-- <li>
                    <a class="nav-item nav-link" href="{{route('logout')}}">Odjava</a>
                    </li> --}}
                    <li class="dropdown">
                        <a href="#" class="nav-item nav-link dropdown-toggle" data-toggle="dropdown">
                            <span class="fa fa-user"></span> 
                            <strong> @if (Auth::user()->roles->pluck('name')->contains('admin'))
                                {{"(Admin)"}}
                                @endif {{Auth::user()->firstname }} {{ Auth::user()->lastname}}</strong>
                            <span class="fa fa-chevron-down"></span>
                        </a>
                        <ul class="dropdown-menu" style="margin-top: 20px">
                            <li>
                                <div class="navbar-login">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <p class="text-center">
                                                <span class="fa fa-user icon-size"></span>
                                            </p>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="text-left"><strong>{{Auth::user()->username }}</strong></div>

                                            <div class="text-left">{{Auth::user()->firstname }}
                                                {{ Auth::user()->lastname}}</div>
                                            <div class="text-left small">{{Auth::user()->email }}</div>
                                            <hr>
                                            <div class="text-left">
                                                <a href="{{route('logout')}}"
                                                    class="btn btn-primary btn-block btn-sm p-1">Odjava</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    @else
                    <li>
                        <a class="nav-item nav-link" href="{{route('login')}}">Prijava</a>
                    </li>
                    <li>
                        <a class="nav-item nav-link" href="{{route('register')}}">Registracija</a>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>