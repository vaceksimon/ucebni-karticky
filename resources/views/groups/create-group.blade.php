@extends('layouts.main')

<!-- **************************** -->
<!-- * Author: David Chocholaty * -->
<!-- * Login: xchoch09          * -->
<!-- **************************** -->

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Vytvoření skupiny') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-group.store') }}">
                            @csrf

                            <div class="row">
                                <div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Typ skupiny') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="type" id="students" value="students"
                                                        {{ old('type') == 'teachers' ? '' : 'checked' }}>
                                                    <label for="students" class="form-check-label">
                                                        Skupina žáků
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="type" id="teachers" value="teachers"
                                                        {{ old('type') == 'teachers' ? 'checked' : '' }}>
                                                    <label for="teachers" class="form-check-label">
                                                        Skupina učitelů
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="name" class="col-form-label text-start">
                                    {{ __('Název *') }} :
                                </label>

                                <div class="col-md-12">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                           oninvalid="this.setCustomValidity('Prosím zadejte název skupiny')"
                                           oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="description" class="col-form-label text-start">
                                    {{ __('Popis') }} :
                                </label>

                                <div class="col-md-12">
                                    <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                              required autocomplete="description" autofocus></textarea>
                                </div>
                            </div>
                            <div class="mb-3 mt-5 d-flex">
                                <a href="{{ route('home') }}">
                                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-3 ms-auto me-0">Vytvořit skupinu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
