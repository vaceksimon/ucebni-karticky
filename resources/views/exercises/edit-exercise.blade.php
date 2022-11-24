@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Úprava cvičení') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit-exercise.store') }}">
                            @csrf

                            <input type="hidden" name="exercise_id" value="<?php echo $exercise[0]->id; ?>">

                            <div class="row row-center row-cols-2">
                                <div>
                                    <div class="mb-3 row row-center">
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Viditelnost') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <label class="form-check-label text-black-50">
                                                    @if($exercise[0]->type == 'private')
                                                        Soukromé cvičení
                                                    @else
                                                        Veřejné cvičení
                                                    @endif
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="name" class="col-form-label text-start">
                                    {{ __('Název *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="<?php echo $exercise[0]->name ?>" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="description" class="col-form-label text-start">
                                    {{ __('Popis') }} :
                                </label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                              required autocomplete="description" autofocus><?php echo $exercise[0]->description ?></textarea>
                                </div>
                            </div>

                            <div class="col-md-12 my-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row row-center row-cols-2">
                                            <div>
                                                {{ __('Kartičky') }}
                                            </div>
                                            <div class="row row-center">
                                                <button type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat kartičky</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div style="height: 300px;overflow-y: scroll;">
                                            <table class="table table-striped">
                                                <thead>
                                                </thead>
                                                @empty($flashcards)
                                                    <div class="text-center">
                                                        Vaše cvičení zatím neobsahuje žádné kartičky.
                                                    </div>
                                                    <div class="row row-center mx-auto my-3" style="width: 120px">
                                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat kartičky</button>
                                                    </div>
                                                @else
                                                    <tbody>
                                                        @foreach($flashcards as $flashcard)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->index + 1 }}
                                                                </td>
                                                                <td>
                                                                    <div style="text-overflow: ellipsis;
                                                                    overflow: hidden;
                                                                    max-width: 15vw;
                                                                    height: 1.2em;
                                                                    white-space: nowrap;">
                                                                        {{ $flashcard->question }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div style="text-overflow: ellipsis;
                                                                    overflow: hidden;
                                                                    max-width: 12vw;
                                                                    height: 1.2em;
                                                                    white-space: nowrap;">
                                                                        {{ $flashcard->answer }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            class="btn btn-outline-danger open-remove-member-dialog"
                                                                            data-id="{{ $flashcard->id }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#removingQuestion">Odebrat</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                @endempty
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3 d-flex">
                                <!--
                                 TODO
                                  - zrušit will navigate to home-page or previous page
                                  - vytvořit skupinu will navigate to moje cviceni page
                                 -->
                                <button class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                <button type="submit" class="btn btn-primary btn-lg px-3 ms-auto me-0">Upravit cvičení</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 75vw;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Přidání kartiček</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
