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
                            @if($role === 'teacher')
                            <div>
                                <ul>
                                    <li><h5>Skupiny učitelů</h5></li>
                                </ul>
                            </div>
                            <div>
                            </div>
                            @foreach($t_teacherGroups as $record)
                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="col-2">
                                                <img class="rounded-circle d-block m-auto" src="{{ $record->photo }}" style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                            </div>
                                            <div class="col-10">
                                                <div>{{ $record->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <div class="" style="width: 120px">
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Upravit skupinu</button>
                                        </div>
                                        <div class="" style="width: 120px">
                                            <button type="button" class="btn btn-primary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail skupiny</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body d-flex">
                                    <div class="row">
                                        <div>Počet učitelů: {{ $record->pocet }}</div>
                                        <div>Popis: {{$record->description}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                            <div>
                                <ul>
                                    <li><h5>Skupiny žáků</h5></li>
                                </ul>
                            </div>
                            @if($role === 'teacher')
                            @foreach($t_studentGroups as $record)
                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="col-2">
                                                <img class="rounded-circle d-block m-auto" src="{{ $record->photo }}" style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                            </div>
                                            <div class="col-10">
                                                <div>{{ $record->name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 d-flex justify-content-end gap-3">
                                        <div class="" style="width: 120px">
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Upravit skupinu</button>
                                        </div>
                                        <div class="" style="width: 120px">
                                            <button type="button" class="btn btn-primary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail skupiny</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body d-flex">
                                    <div class="row">
                                        <div>Počet žáků: {{ $record->pocet }}</div>
                                        <div>Popis: {{$record->description}}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @elseif($role === 'student')
                                @foreach($s_studentGroups as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-2">
                                                        <img class="rounded-circle d-block m-auto" src="{{ $record->photo }}" style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                                    </div>
                                                    <div class="col-10">
                                                        <div>{{ $record->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end gap-3">
                                                <div class="" style="width: 120px">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Upravit skupinu</button>
                                                </div>
                                                <div class="" style="width: 120px">
                                                    <button type="button" class="btn btn-primary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail skupiny</button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body d-flex">
                                            <div class="row">
                                                <div>Počet žáků: {{ $record->pocet }}</div>
                                                <div>Popis: {{$record->description}}</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
