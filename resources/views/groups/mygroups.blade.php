@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Moje skupiny') }}</div>
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="pb-3">
                                <h4>Spravované skupiny</h4>
                            </div>
                            <div>
                                <ul>
                                    <li><h5>Skupiny učitelů</h5></li>
                                </ul>
                            </div>
                            @foreach($teacherGroups as $teacherGroup)
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="col-md-1">
                                            <img class="rounded-circle d-block m-auto" src="{{ $teacherGroup->photo }}" style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                        </div>
                                        <div class="col-md-11">
                                            <div>{{ $teacherGroup->name }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body d-flex">
                                    <div class="col row-center mx-auto my-3" style="width: 120px">
                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
                                    </div>
                                    <div class="col row-center mx-auto my-3" style="width: 120px">
                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach


                            <div>
                                <ul>
                                    <li><h5>Skupiny žáků</h5></li>
                                </ul>
                            </div>
                            @foreach($studentGroups as $studentGroup)
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="col-md-1">
                                            <img class="rounded-circle d-block m-auto" src="{{ $studentGroup->photo }}" style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                        </div>
                                        <div class="col-md-11">
                                            <div>{{ $studentGroup->name }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row row-center mx-auto my-3" style="width: 120px">
                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
