@extends('layouts/app', ['activePage' => 'welcome', 'title' => 'Učební Kartičky'])

@section('content')
    <div class="full-page section-image d-flex justify-content-center align-items-center" data-color="black" style="background-image: url('https://mdbootstrap.com/img/Photos/Others/images/76.jpg'); height: 100vh;">
        <div class="content mask-custom" style="background-color: rgba(0, 0, 0, 0.6); height: 100vh; width: 100vw;">
            <div class="container justify-content-center align-items-center h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-7 col-md-8">
                        <h1 class="text-white text-center mb-0 display-2">{{ __('Učební Kartičky') }}</h1>
                        <div class="col-lg-12 mx-auto">
                            <p class="lead text-white-50 text-center"><i>„Učení vaši mysl nikdy nevyčerpá.“</i></p>
                            <h5 class="text-white-50 text-center pb-4">Leonardo Da Vinci</h5>
                            @guest
                            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                                <form>
                                    <button class="btn btn-primary btn-lg px-4 gap-3" formaction="{{ route('register') }}">Registrovat</button>
                                </form>
                                <a href="{{route('public-exercises')}}">
                                    <button class="btn btn-outline-secondary btn-lg px-4">Procvičovat</button>
                                </a>
                            </div>
                            @endguest
                            @auth
                            <div class="d-grid gap-2 d-sm-flex flex-column align-items-center">
                                <h2 class="text-white pt-5">Jste již přihlášen</h2>
                                <form>
                                    <button class="btn btn-primary btn-lg px-4 gap-3" formaction="{{ route('home') }}">Vstoupit do systému</button>
                                </form>
                            </div>
                            @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
