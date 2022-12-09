@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{url()->previous()}}">
                    <button class="btn btn-outline-secondary mb-2">Zpět</button>
                </a>
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
                            <div class="mb-3 row">
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
                            <div class="row">
                                <img src="{{asset($user['photo'])}}" class="rounded-circle d-flex px-0"
                                     style="width:150px; height: 150px"
                                     alt="Avatar"/>
                            </div>
                        </div>
                        @if($user['account_type'] == 'teacher')
                            <div class="mb-3 row">
                                @if(isset($user['degree_front']))
                                    <div>
                                        Titul před:
                                        {{$user['degree_front']}}
                                    </div>
                                @endif
                                @if(isset($user['degree_after']))
                                    <div>
                                        Titul za:
                                        {{$user['degree_after']}}
                                    </div>
                                @endif
                                @if(isset($user['school']))
                                    <div>
                                        Škola:
                                        {{$user['school']}}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @if($user['id'] != Auth::id())
                    <div class="card mt-3">
                        <div class="card-header">
                            Společné skupiny
                        </div>
                        <div class="card-body">
                            @empty($groups)
                                Nemáte žádné společné skupiny.
                            @endempty
                            @foreach($groups as $group)
                                <div class="row mb-3">
                                    <div class="col">
                                        <div class="card" style="width: 18rem;">
                                            <img src="{{asset($group->photo)}}" class="card-img-top" alt="Foto skupiny">
                                            <div class="card-body">
                                                <h5 class="card-title">{{$group->name}}</h5>
                                                <p class="card-text">{{$group->description}}</p>
                                                <form method="POST" action="{{route('mygroups.clickShow')}}">
                                                    @csrf
                                                    <input type="hidden" id="group_id" name="group_id" value="{{$group->id}}" />
                                                    <button type="submit" class="btn btn-primary">Zobrazit skupinu</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
