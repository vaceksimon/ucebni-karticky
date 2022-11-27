@extends('layouts/errorMain', ['title' => 'Učební Kartičky'])

@section('errorPage')
    <div class="d-flex vh-100">
        <div class="container m-auto" style="border-radius: 5rem;">
            <div class="alert alert-danger text-center m-0">
                <h2 class="display-3">404</h2>
                <h3 class="display-5">Ajaj! Něco se pokazilo.</h3>
                <h5 class="display-6 mb-4">Vaše cesta nevede na správné místo.</h5>
                <a href="{{route('home')}}">
                    <button class="btn btn-info btn-lg px-4 mb-3">Najít správnou cestu</button>
                </a>
            </div>
        </div>
    </div>
@endsection
