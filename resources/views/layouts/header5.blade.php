<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <div class="me-auto">
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
            <ul class="navbar-nav">
                @if (Auth::user())
                <li>
                    <a class="nav-item nav-link" href="{{route('logout')}}">Odjava</a>
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