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
                                                <button id="add-flashcards-btn-1" type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#addFlashcardModal">Přidat kartičky</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body" id="flashcards-table">
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-form-label text-start" style="color: red">
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
                                <a href="{{ url()->previous() }}">
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
                                            <div class="pt-4">
                                                <hr/>
                                            </div>
                                            <div class="row">
                                                <label for="added_flashcards" id="added-flashcards" name="added-flashcards" class="col-form-label py-0 my-0 text-start text-black-50">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="justify-content: flex-start;">
                            <input type="hidden" id="add_flashcard_exercise_id" name="add_flashcard_exercise_id" value="<?php echo $exercise[0]->id;?>">
                            <button type="button" id="add-flashcard-close-btn" class="btn btn-secondary" data-bs-dismiss="modal">Zavřít</button>
                            <button type="button" id="add-flashcard-btn" class="btn btn-primary ms-auto me-0 add-flashcard">Přidat</button>
                        </div>
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
                                                           oninput="setCustomValidity('')">
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
                                                           oninput="setCustomValidity('')">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="justify-content: flex-start;">
                            <input type="hidden" id="flashcard_id_edit" name="flashcard_id_edit" value="">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zrušit</button>
                            <button type="button" id="edit-flashcard-btn" class="btn btn-primary ms-auto me-0 add-flashcard">Upravit</button>
                        </div>
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
                            <input type="hidden" id="flashcard_id" name="flashcard_id" value="">
                            <button type="button" class="btn btn-primary" id="remove-flashcard-btn" data-bs-dismiss="modal" value="">Ano</button>
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
    <script>
        showFlashcards();

        function showFlashcards() {
            $.post('{{ route("edit-exercise.search-flashcards") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                function(data){
                    table_post_row_flashcards(data);
                });
        }

        function table_post_row_flashcards(res) {
            let htmlView = '';
            if(res.result.length <= 0) {
                htmlView += `
                    <div style="height: 300px;overflow-y: scroll;">
                        <table class="table table-striped d-table">
                            <thead class="table-head-sticky">
                                <tr>
                                    <div class="my-5">
                                        <div class="text-center">
                                            Cvičení zatím neobsahuje žádné kartičky.
                                            <i class="bi bi-emoji-frown"></i>
                                        </div>
                                        <div class="row mx-auto my-3" style="width: 120px">
                                            <button id="add-flashcards-btn-2" type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addFlashcardModal">Přidat kartičky</button>
                                        </div>
                                    </div>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>`;
            } else {
                htmlView += `
                    <div style="height: 300px;overflow-y: scroll;">
                            <table class="table table-striped d-table">
                                <thead class="table-head-sticky">
                                    <tr>
                                        <th>Pořadí</th>
                                        <th>Otázka</th>
                                        <th>Odpověď</th>
                                        <th>Upravit</th>
                                        <th>Odebrat</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                for (let i = 0; i < res.result.length; i++) {
                    htmlView += `
                        <tr>
                            <td>` + (i+1) + `</td>
                            <td>
                                <div id="flashcard_question_` + res.result[i].id + `" class="text-shortening" data-value="` + res.result[i].question + `">` +
                                    res.result[i].question + `
                                </div>
                            </td>
                            <td>
                                <div id="flashcard_answer_` + res.result[i].id + `" class="text-shortening" data-value="` + res.result[i].answer + `">` +
                                    res.result[i].answer + `
                                </div>
                            </td>
                            <td>
                                <button type="button"
                                        class="btn btn-outline-primary open-edit-flashcard"
                                        data-id="` + res.result[i].id + `"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editFlashcard">Upravit</button>
                            </td>
                            <td>
                                <button type="button"
                                    class="btn btn-outline-danger open-remove-flashcard-dialog"
                                    data-id="` + res.result[i].id + `"
                                    data-bs-toggle="modal"
                                    data-bs-target="#removingQuestion">Odebrat</button>
                            </td>
                        </tr>
                    `;
                }

                htmlView += `</tbody></table></div>`;
            }

            $('#flashcards-table').html(htmlView);
        }
    </script>
    <script>
        $(document).on("click", "#remove-flashcard-btn", function () {
            removeFlashcard(document.getElementById("flashcard_id").value,
                document.getElementById("exercise_id").value);
        });

        function removeFlashcard(flashcard_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"flashcard_id": flashcard_id},
                url: "{{ route('edit-exercise.remove-flashcard') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '1') {
                        alert("Nepodařilo se odebrat kartičku.");
                    }
                },
                error: function (data) {
                    console.log('Error: ', data);
                },
            });

            showFlashcards();
        }
    </script>
    <script>
        $('#flashcard_question').on('keyup', function(){
            var flashcardQuestionInput = document.getElementById("flashcard_question");
            flashcardQuestionInput.style.boxShadow = 'none';
        });
    </script>
    <script>
        $('#flashcard_answer').on('keyup', function(){
            var flashcardAnswerInput = document.getElementById("flashcard_answer");
            flashcardAnswerInput.style.boxShadow = 'none';
        });
    </script>
    <script>
        var addedCards = 0;

        document.getElementById("added-flashcards").innerHTML = "{{ __('Přidáno kartiček') }}: " + addedCards;

        $(document).on("click", "#add-flashcard-close-btn", function () {
           addedCards = 0;
           document.getElementById("added-flashcards").innerHTML = "{{ __('Přidáno kartiček') }}: " + addedCards;
        });

        $(document).on("click", "#add-flashcard-btn", function () {
            var flashcardQuestionInput = document.getElementById("flashcard_question");
            var flashcardAnswerInput = document.getElementById("flashcard_answer");
            var flashcardQuestion =  flashcardQuestionInput.value;
            var flashcardAnswer = flashcardAnswerInput.value;

            if (flashcardQuestion === '' || flashcardAnswer === '') {
                if (flashcardQuestion === '') {
                    flashcardQuestionInput.style.boxShadow = '0 0 2px red';
                }

                if (flashcardAnswer === '') {
                    flashcardAnswerInput.style.boxShadow = '0 0 2px red';
                }

                alert("Prosím vyplňte všechna požadovaná pole.");

                return;
            }

            addFlashcard(flashcardQuestion, flashcardAnswer,
                document.getElementById("add_flashcard_exercise_id").value);

            addedCards++;
        });

        // The following function is taken from the following source at 2022-12-05:
        // Source: https://www.sitepoint.com/delay-sleep-pause-wait/
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        function addFlashcard(question, answer, exercise_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data: {"flashcard_question": question,
                    "flashcard_answer": answer,
                    "add_flashcard_exercise_id": exercise_id},
                url: "{{ route('edit-exercise.add-flashcard') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '1') {
                        alert("Nepodařilo se přidat kartičku.");
                    }
                },
                error: function (data) {
                    console.log('Error: ', data);
                },
            });

            showFlashcards();

            $("#addFlashcardModal").modal('hide');

            sleep(500).then(() => {
                document.getElementById("flashcard_question").value = '';
                document.getElementById("flashcard_answer").value = '';
                document.getElementById("added-flashcards").innerHTML = "{{ __('Přidáno kartiček') }}: " + addedCards;

                $("#addFlashcardModal").modal('show');
            });
        }
    </script>
    <script>
        $('#flashcard_question_edit').on('keyup', function () {
            var flashcardQuestionInput = document.getElementById("flashcard_question_edit");
            flashcardQuestionInput.style.boxShadow = 'none';
        });
        $('#flashcard_answer_edit').on('keyup', function () {
            var flashcardAnswerInput = document.getElementById("flashcard_answer_edit");
            flashcardAnswerInput.style.boxShadow = 'none';
        });
    </script>
    <script>
        $(document).on("click", "#edit-flashcard-btn", function () {
            var flashcardQuestionInput = document.getElementById("flashcard_question_edit");
            var flashcardAnswerInput = document.getElementById("flashcard_answer_edit");
            var flashcardQuestion =  flashcardQuestionInput.value;
            var flashcardAnswer = flashcardAnswerInput.value;

            if (flashcardQuestion === '' || flashcardAnswer === '') {
                if (flashcardQuestion === '') {
                    flashcardQuestionInput.style.boxShadow = '0 0 2px red';
                }
                if (flashcardAnswer === '') {
                    flashcardAnswerInput.style.boxShadow = '0 0 2px red';
                }

                alert("Prosím vyplňte všechna požadovaná pole.");

                return;
            }

            editFlashcard(document.getElementById("flashcard_id_edit").value,
                flashcardQuestion,
                flashcardAnswer);
        });

        function editFlashcard(flashcard_id, question, answer) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data: {"flashcard_question_edit": question,
                    "flashcard_answer_edit": answer,
                    "flashcard_id_edit": flashcard_id},
                url: "{{ route('edit-exercise.edit-flashcard') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '1') {
                        alert("Nepodařilo se upravit kartičku.");
                    }
                },
                error: function (data) {
                    console.log('Error: ', data);
                },
            });

            showFlashcards();

            $("#editFlashcard").modal('hide');
        }
    </script>
    <script>
        $(document).on("click", "#add-flashcards-btn-1", function () {
            document.getElementById("flashcard_question").value = '';
            document.getElementById("flashcard_answer").value = '';
        });

        $(document).on("click", "#add-flashcards-btn-2", function () {
            document.getElementById("flashcard_question").value = '';
            document.getElementById("flashcard_answer").value = '';
        });
    </script>
@endsection
