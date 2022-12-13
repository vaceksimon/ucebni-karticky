@extends('layouts.main')
<!-- *********************** -->
<!-- * Author: Tomas Bartu * -->
<!-- * Login: xbartu11     * -->
<!-- *********************** -->
@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Moje skupiny') }}</div>
                    <div class="card-body">
                        <div class="col-md-12">
                            @if($role != 'student')
                                <div class="pb-3">
                                    <h3>Spravované skupiny</h3>
                                </div>
                            @endif

                            @if($role === 'teacher')
                                <div>
                                    <ul>
                                        <li><h4>Skupiny učitelů</h4></li>
                                    </ul>
                                </div>
                                @if($t_teacherGroups->isEmpty())
                                    <div class="ps-3 pb-3 fs-5">
                                        Nemáte vytvořenou zatím žádnou skupinu. <i
                                            class="bi bi-emoji-frown"></i>
                                        <form action="{{route('create-group')}}">
                                            <button type="submit"
                                                    class="mt-2 ms-2 btn btn-primary btn-sm px-3 text-nowrap">
                                                <span class="ms-1 d-none d-sm-inline">Vytvořit skupinu</span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                @foreach($t_teacherGroups as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-2">
                                                        <img class="rounded-circle d-block m-auto"
                                                             src="{{ $record->photo }}"
                                                             style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                                    </div>
                                                    <div class="col-10">
                                                        <div>{{ $record->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end gap-3">
                                                <form method="POST" action="{{ route('mygroups.clickEdit') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-outline-secondary btn-sm px-3 text-nowrap">
                                                            Upravit skupinu <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                                <form method="POST" action="{{ route('mygroups.clickShow') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm px-3 text-nowrap">Detail
                                                            skupiny <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>
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
                                    <li><h4>Skupiny žáků</h4></li>
                                </ul>
                            </div>
                            @if($role === 'teacher')
                                @if($t_studentGroups->isEmpty())
                                    <div class="ps-3 pb-3 fs-5">Nemáte vytvořenou zatím žádnou skupinu. <i
                                            class="bi bi-emoji-frown"></i>
                                        <form action="{{route('create-group')}}">
                                            <button type="submit"
                                                    class="mt-2 ms-2 btn btn-primary btn-sm px-3 text-nowrap">
                                                <span class="ms-1 d-none d-sm-inline">Vytvořit skupinu</span>
                                            </button>
                                        </form>
                                    </div>
                                @endif
                                @foreach($t_studentGroups as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-2">
                                                        <img class="rounded-circle d-block m-auto"
                                                             src="{{ $record->photo }}"
                                                             style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                                    </div>
                                                    <div class="col-10">
                                                        <div>{{ $record->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end gap-3">
                                                <form method="POST" action="{{ route('mygroups.clickEdit') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-outline-secondary btn-sm px-3 text-nowrap">
                                                            Upravit skupinu <i class="bi bi-pencil-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>

                                                <form method="POST" action="{{ route('mygroups.clickShow') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm px-3 text-nowrap">Detail
                                                            skupiny <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>
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
                                <div class="pb-3">
                                    <h3>Skupiny, ve kterých jste</h3>
                                </div>
                                @if($t_teacherGroupsGroup->isEmpty())
                                    <div class="ps-3 fs-5">Nejste členem žádné skupiny. <i
                                            class="bi bi-emoji-frown"></i>
                                    </div>
                                @endif
                                @foreach($t_teacherGroupsGroup as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-2">
                                                        <img class="rounded-circle d-block m-auto"
                                                             src="{{ $record->photo }}"
                                                             style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                                    </div>
                                                    <div class="col-10">
                                                        <div>{{ $record->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end gap-3">
                                                <form method="POST" action="{{ route('mygroups.clickShow') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->group_id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm px-3 text-nowrap">Detail
                                                            skupiny <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>
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
                            @elseif($role === 'student')
                                @if($s_studentGroups->isEmpty())
                                    <div class="ps-3 fs-5">Nejste členem žádné skupiny. <i
                                            class="bi bi-emoji-frown"></i>
                                    </div>
                                @endif
                                @foreach($s_studentGroups as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-2">
                                                        <img class="rounded-circle d-block m-auto"
                                                             src="{{ $record->photo }}"
                                                             style=" width: 3rem; height: 3rem;" alt="Avatar"/>
                                                    </div>
                                                    <div class="col-10">
                                                        <div>{{ $record->name }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end gap-3">
                                                <form method="POST" action="{{ route('mygroups.clickShow') }}">
                                                    @csrf

                                                    <div style="width: 135px">
                                                        <input type="hidden" name="group_id" id="group_id"
                                                               value="{{ $record->group_id }}"/>
                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm px-3 text-nowrap">Detail
                                                            skupiny <i class="bi bi-eye-fill"></i>
                                                        </button>
                                                    </div>
                                                </form>
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
