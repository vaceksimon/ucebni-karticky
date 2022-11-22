@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div class="col-11">
                            {{ __('Úprava profilu') }}
                        </div>
                        @if($user['id'] == Auth::id())
                            <div class="col-10">
                                <button class="btn btn-outline-success"
                                        onclick="event.preventDefault(); document.getElementById('edit-form').submit();">
                                    Uložit
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <form id="edit-form" method="POST" action="{{ route('profile.store') }}">
                            @csrf
                            <div class="d-flex flex-nowrap flex-column">
                                <div class="row col-12 d-flex">
                                    <div class="col-6">
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <div>
                                                    <label for="first_name">Jméno:</label>
                                                </div>
                                                <div>
                                                    <input id="first_name" name="first_name" type="text"
                                                           value="{{$user['first_name']}}" placeholder="Jméno">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <label for="last_name">Příjmení:</label>
                                            </div>
                                            <div>
                                                <input id="last_name" name="last_name" type="text"
                                                       value="{{$user['last_name']}}" placeholder="Příjmení">
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <label for="last_name">Email:</label>
                                            </div>
                                            <div>
                                                <input id="email" name="email" type="text"
                                                       value="{{$user['email']}}" placeholder="email">
                                            </div>
                                        </div>
                                        {{--}} <div>
                                             <label for="password">Heslo:</label>
                                             <input id="password" name="password" type="password"
                                                    value="" placeholder="heslo">
                                         </div> {{--}}
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div>
                                                <img src="{{$user['photo']}}" class="rounded-circle d-flex px-0"
                                                     style="width:150px; height: 150px"
                                                     alt="Avatar"/>
                                            </div>
                                            <div style="width: 60%">
                                                <div class="container my-auto">
                                                    <label class="input-group-text my-auto"
                                                           style="width: 75px; cursor: pointer"
                                                           for="photo">Nahrát</label>
                                                    <input type="file" class="form-control" id="photo" value="{{$user['photo']}}"
                                                           style="cursor: pointer" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($user['account_type'] == 'teacher')
                                    <div class="row mt-5">
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Titul před jménem:</label>
                                            </div>
                                            <div>
                                                <input id="degree_front" name="degree_front" type="text"
                                                       value="{{$user['degree_front']}}"
                                                       placeholder="Titul před jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Titul za jménem:</label>
                                            </div>
                                            <div>
                                                <input id="degree_after" name="degree_after" type="text"
                                                       value="{{$user['degree_after']}}" placeholder="Titul za jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Škola:</label>
                                            </div>
                                            <div>
                                                <input id="school" name="school" type="text"
                                                       value="{{$user['school']}}" placeholder="Škola">
                                            </div>
                                        </div>
                                        <div class="">
                                            <input type="submit" value="Uložit" class="btn btn-outline-success"/>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
