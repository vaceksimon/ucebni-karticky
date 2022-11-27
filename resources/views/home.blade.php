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
                        <p class="lead mb-4 text-black-50">
                            Hledáte univerzální způsob, který Vám pomůže naučit se téměř cokoliv? Myslíte si, že se neumíte učit a máte pocit, že Vám nic neleze do hlavy? Metody učení, které momentálně používáte, nefungují? Tak právě pro Vás jsou tu Učební Kartičky. Stačí jen začít. Tak s chutí do toho!
                        </p>
                        <div class="d-flex justify-content-evenly flex-wrap gap-3">
                            @if(Auth::user()->account_type == 'teacher')
                                <form>
                                    <button class="btn btn-primary btn-lg px-4 gap-3" formaction="{{ route('create-exercise') }}">Vytvořit sadu kartiček</button>
                                </form>
                                <form>
                                    <button class="btn btn-outline-secondary btn-lg px-4" formaction="{{ route('create-group') }}">Vytvořit skupinu</button>
                                </form>
                            @elseif(Auth::user()->account_type == 'student')
                                <form>
                                    <button class="btn btn-primary btn-lg px-4 gap-3" formaction="{{ route('myexercises') }}">Moje cvičení</button>
                                </form>
                                <form>
                                    <button class="btn btn-outline-secondary btn-lg px-4" formaction="{{ route('mygroups') }}">Moje skupiny</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
