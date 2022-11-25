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
                                                <button type="button"
                                                        class="btn btn-outline-secondary btn-sm px-3 text-nowrap"
                                                        data-bs-toggle="modal" data-bs-target="#shareModal"
                                                        onclick="exercise_id = {{$record->id}}; share();">
                                                    Sdílet
                                                </button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zadat</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-2" />
                                    <div class="pb-3">Popis:</div>
                                    <div>{{ $record->description }}</div>
                                    <div class="d-flex pt-3 gap-2">
                                        <div class="col-8 d-flex gap-3">
                                            <a href="{{route('myexercises.edit', ['id' => $record->id])}}">
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Upravit</button>
                                            </a>
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

            <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                 aria-hidden="true" style="--bs-modal-width: 75vw;">
                <div class="modal-dialog">
                    <div class="modal-content m-auto w-75">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Sdílet se skupinou učitelů</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <form action="" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control" placeholder="Vyhledat skupinu" id="share">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div class="container" id="shareGroupsBody" name="shareGroupsBody"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script>
        $('#share').on('keyup', function () {
            share();
        });

        function share() {
            let keyword = $('#share').val();
            $.post('{{ route("myexercises.share") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword,
                    owner_id: {{Auth::id()}},
                    exercise_id: exercise_id
                },
                function (data) {
                    postGroups(data);
                });
        }
        // table row with ajax
        function postGroups(res) {
            isShared = JSON.parse(res.isShared);
            htmlView = '';
            for (let i = 0; i < res.result.length; i++) {
                if (i % 3 === 0) {
                    htmlView += `
                        <div class="row mb-3">`
                }
                htmlView += `
                    <div class="col">
                        <div class="card m-auto" style="width: 18rem;">
                            <img src="` + res.result[i].photo + `" class="card-img-top" alt="Foto skupiny">
                            <div class="card-body">
                                <h5 class="card-title">` + res.result[i].name + `</h5>
                                <p class="card-text">` + res.result[i].description + `</p>`
                    if (isShared[i].shared === "1") {
                        htmlView += `<button class="btn btn-danger"
                                onclick="deleteExercise(` + res.result[i].id + `);">Odstranit sdílení</button>`
                    } else {
                        htmlView += `<button class="btn btn-primary"
                                onclick="shareExercise(` + res.result[i].id + `);">Sdílet</button>`
                    }
                htmlView += `</div>
                        </div>
                    </div>
                `
                if ((i + 1) % 3 === 0 || i === (res.result.length + 1))
                    htmlView += `</div>`
            }
            $('#shareGroupsBody').html(htmlView);
        }

        function shareExercise(group_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"exercise_id": exercise_id, "group_id": group_id },
                url: "{{ route('myexercises.store-share') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '0')
                    {
                        alert("Neporařilo se nasdílet skupinu.");
                    }
                    share();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function deleteExercise(group_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"exercise_id": exercise_id, "group_id": group_id },
                url: "{{ route('myexercises.delete-share') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '0')
                    {
                        alert("Neporařilo se odstranit sdílení skupiny.");
                    }
                    share();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>
@endsection
