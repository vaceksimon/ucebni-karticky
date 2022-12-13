<!-- *********************** -->
<!-- * Author: Tomas Bartu * -->
<!-- * Login: xbartu11     * -->
<!-- *********************** -->
@extends('layouts.main')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 id="counter" class="text-center col-4 m-auto" ></h1>
                <div class="card">
                    <div class="card-header">
                        <h1 class="text-center m-auto">Ajaj, něco se pokazilo.</h1>
                    </div>
                    <div class="card-body">
                        <h3 class="text-center m-auto text-danger">K tomuto cvičení nemáte dostatečné oprávnění.</h3>
                    </div>
                    <div class="card-footer">
                        <div class="m-auto text-center">
                            <a href="{{ route('myexercises') }}">
                                <button type="button" class="btn btn-primary" onclick={flipCard()} >Zpět na seznam cvičení</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
