@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            {{ __('Zobrazení profilu') }}
                        </div>
                        @if($user['id'] == Auth::id())
                            <div class="ms-auto">
                                <a href="{{route('profile.edit')}}">
                                    <button class="btn btn-outline-primary">Upravit</button>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row row-cols-2">
                            <div class="mb-3 row row-center">
                                <div>
                                    Jméno:
                                    {{$user['first_name']}}
                                </div>
                                <div>
                                    Příjmení:
                                    {{$user['last_name']}}
                                </div>
                                @if($user['id'] == Auth::id())
                                    <div>
                                        Email:
                                        {{$user['email']}}
                                    </div>
                                @endif
                            </div>
                            <div class="row row-center">
                                <img src="{{asset($user['photo'])}}" class="rounded-circle d-flex px-0" style="width:150px; height: 150px"
                                     alt="Avatar"/>
                            </div>
                        </div>
                        @if($user['account_type'] == 'teacher')
                        <div class="mb-3 row row-center">
                            <div>
                                Titul před:
                                {{$user['degree_front']}}
                            </div>
                            <div>
                                Titul za:
                                {{$user['degree_after']}}
                            </div>
                            <div>
                                Škola:
                                {{$user['school']}}
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
