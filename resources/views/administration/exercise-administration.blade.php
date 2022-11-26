@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Správa cvičení') }}
                    </div>

                    <div class="card-body">
                        <div class="row mt-5">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Vyhledat cvičení" id="search">
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <div style="height: 500px;overflow-y: scroll;">
                                            <table class="table table-striped d-table">
                                                <thead class="table-head-sticky">
                                                <tr>
                                                    <th>Pořadí</th>
                                                    <th>Název</th>
                                                    <th>Typ cvičení</th>
                                                    <th>Akce</th>
                                                </tr>
                                                </thead>
                                                <tbody id="exercises_table">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="removingQuestion" class="modal fade" tabindex="-1" aria-labelledby="addExerciseModalLabel" aria-hidden="true" role="dialog">
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
                            <form method="post" action="{{ route('exercise-administration.remove-exercise') }}">
                                @csrf

                                <input type="hidden" id="exercise_id" name="exercise_id" value="">
                                <button type="submit" class="btn btn-primary">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>$('#search').on('keyup', function(){
            search();
        });
        search();
        function search(){
            var keyword = $('#search').val();
            $.post('{{ route("exercise-administration.search") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword,
                },
                function(data){
                    table_post_row(data);
                    console.log(data);
                });
        }
        // table row with ajax
        function table_post_row(res){
            let htmlView = '';
            if(res.result.length <= 0){
                htmlView += `
            <tr>
                <td colspan="4">Nebyla nalezena žádná cvičení.</td>
            </tr>`;
            }
            for(let i = 0; i < res.result.length; i++){
                if (res.result[i].visibility === 'private'){
                    res.result[i].visibility = "Soukromé cvičení";
                } else{
                    res.result[i].visibility = "Veřejné cvičení";
                }

                var url = '{{ route("exercise-administration.redirect-to-exercise", ["exercise_id" => "rpl"]) }}';
                url = url.replace('rpl', res.result[i].id);
                var exercise = '{{ ":id" }}';
                exercise = exercise.replace(':id', res.result[i].id);

                htmlView += `
            <tr>
                <td class="clickable-row" data-href="` + url + `">`+ (i+1) +`</td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].name+`</td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].visibility+`</td>
                <td>
                    <button type="button"
                        class="btn btn-outline-danger open-remove-exercise-dialog"
                        data-id="` + exercise + `"
                        data-bs-toggle="modal"
                        data-bs-target="#removingQuestion">Odebrat</button>
                </td>
            </tr>`;
            }
            $('#exercises_table').html(htmlView);
        }
    </script>
    <script>
        $(document).on("click", ".clickable-row", function() {
            window.location = $(this).data("href");
        });
    </script>
    <script>
        // https://stackoverflow.com/questions/10626885/passing-data-to-a-bootstrap-modal
        $(document).on("click", ".open-remove-exercise-dialog", function () {
            var exercise = $(this).data('id');
            $(".modal-footer #exercise_id").val( exercise );
        });
    </script>
@endsection
