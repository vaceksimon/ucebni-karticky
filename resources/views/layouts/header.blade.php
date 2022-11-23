<nav class="navbar navbar-expand-lg bg-light shadow">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fs-1" href="{{ route('home') }}">
                        <i class="bi-journals"></i>
                        Učební kartičky
                    </a>
                </li>
            </ul>

            <div class="btn-group">
                <img src="{{Auth::user()->photo}}" class="rounded-circle d-flex dropdown-toggle"
                     data-bs-toggle="dropdown"
                     style="width: 60px; height: 60px; cursor:pointer" ;
                     alt="Avatar"/>
                <ul class="dropdown-menu dropdown-menu-xxl-end">
                    <li>
                        <a href="{{route('profile')}}" style="text-decoration: none">
                            <button class="dropdown-item fs-4" type="button">
                                Můj profil
                            </button>
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item text-danger fs-4" type="button"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Odhlásit se
                        </button>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
