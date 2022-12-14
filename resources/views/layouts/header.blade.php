<!-- ************************************* -->
<!-- * Author: Simon Vacek               * -->
<!-- * Login: xvacek10                   * -->
<!-- ************************************* -->

<nav class="navbar navbar-expand bg-light shadow" id="navbar">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2">
                <li class="nav-item">
                    <a class="nav-link fs-3" href="{{ route('home') }}">
                        <i class="bi-journals" style="font-size: calc(1.2825rem + 0.39vw) !important"></i>
                        Učební kartičky
                    </a>
                </li>
            </ul>

            <div class="btn-group">
                <img src="{{asset(Auth::user()->photo)}}" class="rounded-circle d-flex dropdown-toggle"
                     data-bs-toggle="dropdown"
                     style="width: 3rem; height: 3rem; cursor:pointer";
                     alt="Avatar"/>
                <ul class="dropdown-menu dropdown-menu-end" style="width: max-content !important; max-width: 250px;">
                    <li class="align-items-center">
                        <p class="mx-2 my-0 ps-2 pe-2 fs-6">Přihlášen jako</p>
                        <p class="mx-2 my-0 ps-2 pe-2 fs-5"><b>{{Auth::user()->degree_front}} {{Auth::user()->first_name}} {{Auth::user()->last_name}} {{Auth::user()->degree_after}}</b></p>
                        <hr />
                    </li>
                    <li>
                        <a href="{{route('profile')}}" style="text-decoration: none">
                            <button class="dropdown-item fs-5" type="button">
                                Můj profil
                            </button>
                        </a>
                    </li>
                    <li>
                        <button class="dropdown-item text-danger fs-5" type="button"
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
