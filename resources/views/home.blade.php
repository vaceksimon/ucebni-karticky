@extends('layouts.main')

@section('content')
    <div class="col-6 p-0">
        <img class="flex-shrink-0 h-100 w-100" style="object-fit: cover" src="/img/flashcards.jpg" alt="random image">
    </div>
    <div class="col-6 p-0">
        <div class="container justify-content-center align-items-center h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-md-10 col-sm-10">
                    <h1 class="text-black text-center mb-0 display-4">{{ __('Učební Kartičky') }}</h1>
                    <div class="col-lg-12 mx-auto">
                        <p class="lead mb-4 text-black-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        <div class="d-flex justify-content-evenly flex-wrap gap-3">
                            <form>
                                <button class="btn btn-primary btn-lg px-4 gap-3" formaction="{{ route('register') }}">Vytvořit sadu kartiček</button>
                            </form>
                            <form>
                                <button class="btn btn-outline-secondary btn-lg px-4">Vytvořit skupinu</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
