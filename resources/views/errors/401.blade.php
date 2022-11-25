@extends('layouts/errorMain', ['title' => 'Učební Kartičky'])

@section('errorPage')
    <div class="d-flex vh-100">
        <div class="container m-auto" style="border-radius: 5rem;">
            <div class="alert alert-danger text-center m-0">
                <h2 class="display-3">401</h2>
                <h3 class="display-5">Ajaj! Něco se pokazilo.</h3>
                <h5 class="display-6 mb-4">Je potřeba, abyste se přihlásili.</h5>
                <a href="{{route('login')}}">
                    <button class="btn btn-info btn-lg px-4 mb-3">Přihlásit se</button>
                </a>
            </div>
        </div>
    </div>
@endsection
