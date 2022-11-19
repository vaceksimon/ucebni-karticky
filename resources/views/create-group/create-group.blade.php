@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Vytvoření skupiny') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-group') }}">
                            @csrf

                            <div class="row row-center row-cols-2">
                                <div>
                                    <div class="mb-3 row row-center">
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

                                    <div class="mb-3 row row-center">
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Viditelnost') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="visibility" id="private" value="private"
                                                        {{ old('visibility') == 'public' ? '' : 'checked' }}>
                                                    <label for="private" class="form-check-label">
                                                        Soukromá skupina
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="visibility" id="public" value="public"
                                                        {{ old('visibility') == 'public' ? 'checked' : '' }}>
                                                    <label for="private" class="form-check-label">
                                                        Veřejná skupina
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <!-- Second column -->
                                    <div class="row row-center">
                                        <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle d-flex mx-auto"
                                             style="width: 120px;"
                                             alt="Avatar"/>
                                    </div>
                                    <div class="row row-center">
                                        <button class="btn btn-outline-primary btn-sm px-3 col-3 mt-3 mx-auto" style="width: 120px">Upravit</button>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="name" class="col-form-label text-start">
                                    {{ __('Název *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="description" class="col-form-label text-start">
                                    {{ __('Popis') }} :
                                </label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                              required autocomplete="description" autofocus>
                                    </textarea>
                                </div>
                            </div>

                            <div class="col-md-12 my-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row row-center row-cols-2">
                                            <div>
                                                {{ __('Členové') }}
                                            </div>
                                            <div class="row row-center">
                                                <button class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px">Přidat člena</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="text-center">
                                            Vaše skupina zatím neobsahuje žádné členy.
                                        </div>
                                        <div class="row row-center mx-auto my-3" style="width: 120px">
                                            <button class="btn btn-outline-primary btn-sm px-3">Přidat člena</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3 d-flex">
                                <button class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                <button class="btn btn-primary btn-lg px-3 ms-auto me-0">Vytvořit skupinu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
