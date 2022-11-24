@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Moje cvičení') }}</div>
                    @if($role === 'teacher')
                    <div class="card-body">
                        <div class="col-md-12">
                            <h2>Vámi vytvořená cvičení</h2>
                            @foreach($t_exercises as $record)
                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-1">
                                            <div> {{ $record->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="col-6">
                                            <div>Počet kartiček: {{ $record->pocet }}</div>
                                            <div>Téma: {{ $record->topic }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Sdílet</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zadat</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-2" />
                                    <div class="pb-3">Popis:</div>
                                    <div>{{ $record->description }}</div>
                                    <div class="d-flex pt-3 gap-2">
                                        <div class="col-8 d-flex gap-3">
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Upravit</button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit statistiky</button>
                                            <a href="{{route('flashcard.show', ['id' => $record->id])}}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit</button>
                                            </a>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <a href="{{route('flashcardPractise.show', ['id' => $record->id])}}">
                                                <button type="button" class="btn btn-primary btn-sm px-3 me-3 text-nowrap" >Spustit</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <h2>Ostatní dostupná cvičení</h2>
                            @foreach($t_sharedExercises as $record)
                                <div class="card mb-3">
                                    <div class="card-header d-flex align-items-center">
                                        <div class="col-6">
                                            <div class="d-flex align-items-center gap-1">
                                                <div> {{ $record->e_name }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="col-6">
                                                <div>Počet kartiček: {{ $record->pocet }}</div>
                                                <div>Téma: {{ $record->topic }}</div>
                                                <div>Skupina: {{ $record->g_name }}</div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-end gap-3">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zadat</button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="my-2" />
                                        <div class="pb-3">Popis:</div>
                                        <div>{{ $record->description }}</div>
                                        <div class="d-flex pt-3 gap-2">
                                            <div class="col-8 d-flex gap-3">
                                                <a href="{{route('flashcard.show', ['id' => $record->id])}}">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit</button>
                                                </a>
                                            </div>
                                            <div class="col-4 d-flex justify-content-end">
                                                <a href="{{route('flashcardPractise.show', ['id' => $record->id])}}">
                                                    <button type="button" class="btn btn-primary btn-sm px-3 me-3 text-nowrap" >Spustit</button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($role === 'student')
                        <div class="card-body">
                            <div class="col-md-12">
                                @foreach($s_exercises as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-6"> {{ $record->e_name }} </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-end">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="col">
                                                    <div>Počet kartiček: {{ $record->count }} </div>
                                                    <div>Téma: {{ $record->topic }}</div>
                                                    <div>Skupina: {{ $record->g_name }}</div>
                                                </div>
                                            </div>
                                            <hr class="my-2" />
                                            <div class="pb-3">Popis:</div>
                                            <div> {{ $record->description }} </div>
                                            <div class="d-flex pt-3 gap-2">
                                                <div class="col-8 d-flex gap-3">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit statistiky</button>
                                                    <a href="{{route('flashcard.show', ['id' => $record->id])}}">
                                                        <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit</button>
                                                    </a>
                                                </div>
                                                <div class="col-4 d-flex justify-content-end">
                                                    <a href="{{route('flashcardPractise.show', ['id' => $record->id])}}">
                                                        <button type="button" class="btn btn-primary btn-sm px-3 me-3 text-nowrap" >Spustit</button>
                                                    </a>
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
    </div>
@endsection
