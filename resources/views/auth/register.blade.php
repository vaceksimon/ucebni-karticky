@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Registrace') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mb-3 row row-center">
                                <label for="" class="col-form-label text-start offset-md-6">
                                    {{ __('Typ účtu') }} :
                                </label>

                                <div class="col-md-6">
                                    <div>
                                        <div>
                                            <input type="radio" onclick="javascript:showExtendedRegistration()" id="student" name="account-type" value="student" checked>
                                            <label for="student">Žák</label>
                                        </div>
                                        <div>
                                            <input type="radio" onclick="javascript:showExtendedRegistration()" id="teacher" name="account-type" value="teacher">
                                            <label for="teacher">Učitel</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="email" class="col-form-label text-start offset-md-6">
                                    {{ __('Emailová adresa *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                           name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="degree-front-field" class="mb-3 row row-center hide-by-default">
                                <label for="degree_front" class="col-form-label text-start offset-md-6">
                                    {{ __('Tituly před') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="degree_front" type="text" class="form-control @error('degree_front') is-invalid @enderror"
                                           name="degree_front" value="{{ old('degree_front') }}" autocomplete="degree_front" autofocus>

                                    @error('degree_front')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="first_name" class="col-form-label text-start offset-md-6">
                                    {{ __('Jméno *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror"
                                           name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="last_name" class="col-form-label text-start offset-md-6">
                                    {{ __('Příjmení *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror"
                                           name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>

                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="degree-after-field" class="mb-3 row row-center hide-by-default">
                                <label for="degree_after" class="col-form-label text-start offset-md-6">
                                    {{ __('Tituly za') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="degree_after" type="text" class="form-control @error('degree_after') is-invalid @enderror"
                                           name="degree_after" value="{{ old('degree_after') }}" autocomplete="degree_after" autofocus>

                                    @error('degree_after')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div id="school-field" class="mb-3 row row-center hide-by-default">
                                <label for="school" class="col-form-label text-start offset-md-6">
                                    {{ __('Škola') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="school" type="text" class="form-control @error('school') is-invalid @enderror"
                                           name="school" value="{{ old('school') }}" autocomplete="school" autofocus>

                                    @error('school')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="password" class="col-form-label text-start offset-md-6">
                                    {{ __('Heslo *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="password-confirm" class="col-form-label text-start offset-md-6">
                                    {{ __('Heslo znovu *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="mt-4 mb-3">
                                <div class="row row-center">
                                    <button type="submit" class="btn btn-primary col-md-3">
                                        {{ __('Registrovat se') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
