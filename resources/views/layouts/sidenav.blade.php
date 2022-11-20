<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 shadow" style="background: #f8f8f8">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2">
        <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start fs-4" id="menu"
            style="--bs-nav-link-color: none">
            <li class="nav-item">
                <a href="{{route('home')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline active">Domů</span>
                </a>
            </li>
            <li>
                <a href="{{route('mygroups')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Skupiny</span>
                </a>
                @if(request()->routeIs('mygroups'))
                    <ul class="collapse show nav flex-column ms-1 fs-5" data-bs-parent="#menu"
                        style="--bs-nav-link-color: none">
                        <li class="w-100">
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Moje skupiny</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span
                                    class="d-none d-sm-inline">Veřejné skupiny</span></a>
                        </li>
                    </ul>
                @endif
            </li>
            <li>
                <a href="{{route('myexercises')}}" class="nav-link align-middle px-0">
                    <i class="fs-4 bi-file-text"></i> <span class="ms-1 d-none d-sm-inline">Cvičení</span>
                </a>
                @if(request()->routeIs('myexercises'))
                    <ul class="collapse show nav flex-column ms-1 fs-5" data-bs-parent="#menu"
                        style="--bs-nav-link-color: none">
                        <li class="w-100">
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Moje cvičení</span></a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span
                                    class="d-none d-sm-inline">Veřejné cvičení</span></a>
                        </li>
                    </ul>
                @endif
            </li>
            <li>
                <a href="" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-plus"></i> <span class="ms-1 d-none d-sm-inline fs-5">Vytvořit skupinu</span>
                </a>
            </li>
            <li>
                <a href="{{ route('create-exercise') }}" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                    <i class="fs-4 bi-plus"></i> <span class="ms-1 d-none d-sm-inline fs-5">Vytvořit cvičení</span>
                </a>
            </li>
        </ul>
    </div>
</div>
