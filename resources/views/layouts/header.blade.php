<nav class="navbar navbar-expand-lg bg-light shadow">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link fs-3" href="{{ route('home') }}">
                        <i class="bi-journals"></i>
                        Učební kartičky
                    </a>
                </li>
            </ul>

            <div class="btn-group">
                <img src="{{asset(Auth::user()->photo)}}" class="rounded-circle d-flex dropdown-toggle"
                     data-bs-toggle="dropdown"
                     style="width: 3rem; height: 3rem; cursor:pointer";
                     alt="Avatar"/>
                <ul class="dropdown-menu dropdown-menu-xxl-end" style="width: max-content !important; max-width: 200px;">
                    <li class="align-items-center">
                        <p class="mx-2 my-0 ps-2 pe-2">Přihlášen jako</p>
                        <p class="mx-2 my-0 ps-2 pe-2"><b>{{Auth::user()->degree_front}} {{Auth::user()->first_name}} {{Auth::user()->last_name}} {{Auth::user()->degree_after}}</b></p>
                        <hr />
                    </li>
                    <li>
                        <a href="{{route('profile')}}" style="text-decoration: none">
                            <button class="dropdown-item fs-6" type="button">
                                Můj profil
                            </button>
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item text-danger fs-6" type="button"
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
