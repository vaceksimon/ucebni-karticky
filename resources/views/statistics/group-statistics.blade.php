@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{__('Statistiky cvičení')}}
                    </div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header d-flex align-items-center">
                                <div>
                                    Cvičení: {{$exercise->name}}
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-outline-secondary">Zpět na cvičení</button>
                                </div>
                            </div>
                            <div class="card-body m-2">
                                <div class="row mb-1">
                                    Téma: {{$exercise->topic}}
                                </div>
                                <div class="row mb-1">
                                    Popis: {{$exercise->description}}
                                </div>
                                <div class="row mb-1">
                                    Počet kartiček: {{$exercise->count}}
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <div>
                                    Skupina: {{$group->name}}
                                </div>
                                <div class="ms-auto">
                                    <button class="btn btn-outline-secondary">Zpět na skupinu</button>
                                </div>
                            </div>
                            <div class="card-body m-2 row">
                                <div class="col-7">
                                    Popis: {{$group->description}}
                                </div>
                                <div class="col-5">
                                    <img src="{{asset($group->photo)}}" class="rounded-circle" style="width: 60px; height: 60px;" alt="Fotka skupiny" />
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
