<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 shadow" style="background: #f8f8f8">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2">
        @if(Auth::user()['account_type'] != 'admin')
            <!-- user and teacher menu -->
            <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start fs-5" id="menu"
                style="--bs-nav-link-color: none">
                <li class="nav-item">
                    <a href="{{route('home')}}"
                       class="nav-link align-middle px-0 @if(request()->routeIs('home')) active @endif">
                        <i class="fs-5 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Domů</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('mygroups')}}" class="nav-link align-middle px-0">
                        <i class="fs-5 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Skupiny</span>
                    </a>
                    @if(request()->routeIs('mygroups'))
                        <ul class="collapse show nav flex-column ms-1 fs-5" data-bs-parent="#menu"
                            style="--bs-nav-link-color: none">
                            <li class="w-100 nav-item">
                                <a href="#"
                                   class="nav-link px-0 @if(request()->routeIs('mygroups')) active @endif"> <span
                                        class="d-none d-sm-inline">Moje skupiny</span></a>
                            </li>
                        </ul>
                    @endif
                </li>
                <li class="nav-item">
                    <a href="{{route('myexercises')}}" class="nav-link align-middle px-0">
                        <i class="fs-5 bi-file-text"></i> <span class="ms-1 d-none d-sm-inline">Cvičení</span>
                    </a>
                    @if(request()->routeIs('myexercises') || request()->routeIs('public-exercises'))
                        <ul class="collapse show nav flex-column ms-1 fs-5" data-bs-parent="#menu"
                            style="--bs-nav-link-color: none">
                            <li class="w-100 nav-item">
                                <a href="{{ route('myexercises') }}" class="nav-link px-0 @if(request()->routeIs('myexercises')) active @endif">
                                    <span class="d-none d-sm-inline">Moje cvičení</span></a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('public-exercises') }}" class="nav-link px-0 @if(request()->routeIs('public-exercises')) active @endif"> <span
                                        class="d-none d-sm-inline">Veřejné cvičení</span></a>
                            </li>
                        </ul>
                    @endif
                </li>
                @if(Auth::user()['account_type'] == 'teacher')
                    <li class="nav-item">
                        <a href="{{route('create-group')}}"
                           class="nav-link px-0 align-middle @if(request()->routeIs('')) active @endif">
                            <i class="fs-5 bi-plus"></i> <span
                                class="ms-1 d-none d-sm-inline fs-5">Vytvořit skupinu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('create-exercise')}}"
                           class="nav-link px-0 align-middle @if(request()->routeIs('')) active @endif">
                            <i class="fs-5 bi-plus"></i> <span
                                class="ms-1 d-none d-sm-inline fs-5">Vytvořit cvičení</span>
                        </a>
                    </li>
                @endif
            </ul>

        @else
            <!-- admin menu -->
            <ul class="nav flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start fs-5" id="menu"
                style="--bs-nav-link-color: none">
                <li class="nav-item">
                    <a href="{{route('home')}}"
                       class="nav-link align-middle px-0 @if(request()->routeIs('home')) active @endif">
                        <i class="fs-5 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Domů</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('user-administration')}}"
                       class="nav-link align-middle px-0 @if(request()->routeIs('user-administration') || request()->routeIs('profile')) active @endif">
                        <i class="fs-5 bi-person"></i> <span class="ms-1 d-none d-sm-inline">Správa uživatelů</span>
                    </a>
                <li class="nav-item">
                    <a href="{{route('group-administration')}}" class="nav-link align-middle px-0 @if(request()->routeIs('group-administration') || request()->routeIs('edit-group')) active @endif">
                        <i class="fs-5 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Správa skupin</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('exercise-administration')}}" class="nav-link align-middle px-0">
                        <i class="fs-5 bi-file-text"></i> <span class="ms-1 d-none d-sm-inline">Správa cvičení</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('create-group')}}"
                       class="nav-link px-0 align-middle @if(request()->routeIs('')) active @endif">
                        <i class="fs-5 bi-plus"></i> <span class="ms-1 d-none d-sm-inline fs-5">Vytvořit skupinu</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('create-exercise')}}"
                       class="nav-link px-0 align-middle @if(request()->routeIs('')) active @endif">
                        <i class="fs-5 bi-plus"></i> <span class="ms-1 d-none d-sm-inline fs-5">Vytvořit cvičení</span>
                    </a>
                </li>
            </ul>
        @endif
    </div>
</div>
