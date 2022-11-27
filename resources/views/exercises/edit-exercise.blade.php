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

                            <div class="row row-cols-2">
                                <div>
                                    <div class="mb-3 row">
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Viditelnost') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <label class="form-check-label text-black-50">
                                                    @if($exercise[0]->visibility == 'private')
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

                            <div class="mb-3 row">
                                <label for="name" class="col-form-label text-start">
                                    {{ __('Název *') }} :
                                </label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control"
                                           name="name" value="<?php echo $exercise[0]->name ?>" required autocomplete="name" autofocus
                                           oninvalid="this.setCustomValidity('Prosím zadejte název cvičení')"
                                           oninput="setCustomValidity('')">
                                </div>
                            </div>

                            <div class="mb-3 row">
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
                                        <div class="row row-cols-2">
                                            <div>
                                                {{ __('Kartičky') }}
                                            </div>
                                            <div class="row">
                                                <button type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#addFlashcardModal">Přidat kartičky</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div style="height: 300px;overflow-y: scroll;">
                                            <table class="table table-striped">
                                                <thead>
                                                </thead>
                                                @empty($flashcards[0])
                                                    <tbody>
                                                        <tr>
                                                            <div class="my-5">
                                                                <div class="text-center">
                                                                    Cvičení zatím neobsahuje žádné kartičky.
                                                                    <i class="bi bi-emoji-frown"></i>
                                                                </div>
                                                                <div class="row mx-auto my-3" style="width: 120px">
                                                                    <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addFlashcardModal">Přidat kartičky</button>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                        @foreach($flashcards as $flashcard)
                                                            <tr>
                                                                <td>
                                                                    {{ $loop->index + 1 }}
                                                                </td>
                                                                <td>
                                                                    <div id="flashcard_question_{{ $flashcard->id }}" class="text-shortening" data-value="{{ $flashcard->question }}">
                                                                        {{ $flashcard->question }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div id="flashcard_answer_{{ $flashcard->id }}" class="text-shortening" data-value="{{ $flashcard->answer }}">
                                                                        {{ $flashcard->answer }}
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            class="btn btn-outline-primary open-edit-flashcard"
                                                                            data-id="{{ $flashcard->id }}"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editFlashcard">Upravit</button>
                                                                </td>
                                                                <td>
                                                                    <button type="button"
                                                                            class="btn btn-outline-danger open-remove-flashcard-dialog"
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

                            <div class="mb-3 row">
                                <label for="delete-exercise" class="col-form-label text-start" style="color: red">
                                    <b>{{ __('Nebezpečná zóna') }}</b> :
                                </label>

                                <div class="pb-5">
                                    <button id="delete-exercise"
                                            type="button"
                                            class="btn btn-outline-danger px-4 gap-3"
                                            data-id="{{ session('group_id') }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletingQuestion">Smazat cvičení</button>
                                </div>
                            </div>

                            <div class="my-3 d-flex">
                                <a
                                    @if((Auth::user()->account_type != "admin"))
                                        href="{{ route('myexercises') }}"
                                    @else
                                        href="{{ route('exercise-administration') }}"
                                    @endif
                                >
                                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-3 ms-auto me-0">Upravit cvičení</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addFlashcardModal" name="addFlashcardModal" tabindex="-1" aria-labelledby="addFlashcardModalLabel" aria-hidden="true" style="--bs-modal-width: 55vw;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFlashcardModalLabel">Přidání kartičky</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('edit-exercise.add-flashcard') }}">
                            @csrf

                            <div class="modal-body">
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3 row offset-lg-4">
                                                    <label for="flashcard_question" class="col-form-label text-start">
                                                        {{ __('Otázka *') }} :
                                                    </label>

                                                    <div class="col-lg-6">
                                                        <input id="flashcard_question" name="flashcard_question" type="text" class="form-control @error('flashcard_question') is-invalid @enderror"
                                                               maxlength="255"
                                                               value="{{ old('question') }}" required autocomplete="question" autofocus
                                                               oninvalid="this.setCustomValidity('Prosím zadejte otázku')"
                                                               oninput="setCustomValidity('')">

                                                        @error('flashcard_question')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>Otázka musí být vyplněna.</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row offset-lg-4">
                                                    <label for="flashcard_answer" class="col-form-label text-start">
                                                        {{ __('Odpověď *') }} :
                                                    </label>

                                                    <div class="col-lg-6">
                                                        <input id="flashcard_answer" name="flashcard_answer" type="text" class="form-control @error('flashcard_answer') is-invalid @enderror"
                                                               maxlength="255"
                                                               value="{{ old('answer') }}" required autocomplete="question" autofocus
                                                               oninvalid="this.setCustomValidity('Prosím zadejte odpověď')"
                                                               oninput="setCustomValidity('')">

                                                        @error('flashcard_answer')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>Odpověď musí být vyplněna.</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="justify-content: flex-start;">
                                <input type="hidden" id="add_flashcard_exercise_id" name="add_flashcard_exercise_id" value="<?php echo $exercise[0]->id;?>">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                                <button type="submit" class="btn btn-primary ms-auto me-0 add-flashcard">Přidat</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editFlashcard" name="editFlashcard" tabindex="-1" aria-labelledby="editFlashcardModalLabel" aria-hidden="true" style="--bs-modal-width: 55vw;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editFlashcardModalLabel">Úprava kartičky</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="{{ route('edit-exercise.edit-flashcard') }}">
                            @csrf

                            <div class="modal-body">
                                <div class="row mt-5">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mb-3 row offset-lg-4">
                                                    <label for="flashcard_question_edit" class="col-form-label text-start">
                                                        {{ __('Otázka *') }} :
                                                    </label>

                                                    <div class="col-lg-6">
                                                        <input id="flashcard_question_edit" name="flashcard_question_edit" type="text" class="form-control @error('flashcard_question_edit') is-invalid @enderror"
                                                               maxlength="255"
                                                               value="" required autocomplete="question" autofocus
                                                               oninvalid="this.setCustomValidity('Prosím zadejte otázku')"
                                                               oninput="setCustomValidity('')">

                                                        @error('flashcard_question_edit')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>Otázka musí být vyplněna.</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="mb-3 row offset-lg-4">
                                                    <label for="flashcard_answer_edit" class="col-form-label text-start">
                                                        {{ __('Odpověď *') }} :
                                                    </label>

                                                    <div class="col-lg-6">
                                                        <input id="flashcard_answer_edit" name="flashcard_answer_edit" type="text" class="form-control @error('flashcard_answer_edit') is-invalid @enderror"
                                                               maxlength="255"
                                                               value="" required autocomplete="question" autofocus
                                                               oninvalid="this.setCustomValidity('Prosím zadejte odpověď')"
                                                               oninput="setCustomValidity('')">

                                                        @error('flashcard_answer_edit')
                                                        <span class="invalid-feedback" role="alert">
                                                                <strong>Odpověď musí být vyplněna.</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer" style="justify-content: flex-start;">
                                <input type="hidden" id="flashcard_id_edit" name="flashcard_id_edit" value="">
                                <input type="hidden" id="exercise_id_edit" name="exercise_id_edit" value="{{ session('exercise_id') }}">
                                <input type="hidden" id="exercise_name_edit" name="exercise_name_edit" value="">
                                <input type="hidden" id="exercise_description_edit" name="exercise_description_edit" value="">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                                <button type="submit" class="btn btn-primary ms-auto me-0 add-flashcard">Upravit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div id="removingQuestion" class="modal fade" tabindex="-1" aria-labelledby="addFlashcardModalLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upozornění</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Opravdu si přejete odebrat kartičku ze cvičení?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('edit-exercise.remove-flashcard') }}">
                                @csrf

                                <input type="hidden" id="flashcard_id" name="flashcard_id" value="">
                                <input type="hidden" id="exercise_id" name="exercise_id" value="{{ session('exercise_id') }}">
                                <input type="hidden" id="exercise_name" name="exercise_name" value="">
                                <input type="hidden" id="exercise_description" name="exercise_description" value="">
                                <button type="submit" class="btn btn-primary">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="deletingQuestion" class="modal fade" tabindex="-1" aria-hidden="true" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upozornění</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Opravdu si přejete smazat cvičení?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('edit-exercise.delete-exercise') }}">
                                @csrf

                                <input type="hidden" id="exercise_id" name="exercise_id" value="{{ session('exercise_id') }}">
                                <button type="submit" class="btn btn-danger">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".open-remove-flashcard-dialog", function () {
            var flashcard = $(this).data('id');
            var exerciseName = document.getElementById("name").value;
            var exerciseDescription = document.getElementById("description").value;

            $(".modal-footer #flashcard_id").val( flashcard );
            $(".modal-footer #exercise_name").val( exerciseName );
            $(".modal-footer #exercise_description").val( exerciseDescription );
        });

        $(document).on("click", ".open-edit-flashcard", function () {
            var flashcard = $(this).data('id');

            var questionId = "flashcard_question_";
            questionId = questionId.concat(flashcard);

            var answerId = "flashcard_answer_";
            answerId = answerId.concat(flashcard);

            var exerciseName = document.getElementById("name").value;
            var exerciseDescription = document.getElementById("description").value;

            var question = document.getElementById(questionId).getAttribute('data-value');
            var answer = document.getElementById(answerId).getAttribute('data-value');

            $(".modal-footer #flashcard_id_edit").val( flashcard );
            $(".modal-body #flashcard_question_edit").val( question );
            $(".modal-body #flashcard_answer_edit").val( answer );
            $(".modal-footer #exercise_name_edit").val( exerciseName );
            $(".modal-footer #exercise_description_edit").val( exerciseDescription );
        });
    </script>
@endsection
