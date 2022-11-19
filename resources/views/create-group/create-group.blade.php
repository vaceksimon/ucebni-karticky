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
                                              value="{{ old('description') }}" required autocomplete="description" autofocus>
                                    </textarea>
                                </div>
                            </div>

                            <button class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                            <button class="btn btn-primary btn-lg px-3">Vytvořit skupinu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
