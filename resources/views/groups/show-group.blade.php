@extends('layouts.main')

<!-- ****************************** -->
<!-- * Authors: David Chocholaty  * -->
<!-- *          Simon Vacek       * -->
<!-- * Logins: xchoch09, xvacek10 * -->
<!-- ****************************** -->

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="my-3 row d-flex">
                    <a href="javascript:window.history.back()">
                        <input type="button" class="btn btn-outline-secondary btn-md px-3" value="Zpět">
                    </a>
                </div>

                <div class="card">
                    <div class="card-header">{{ __('Zobrazení skupiny') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-7">
                                <div class="mb-3 row">
                                    <label for="" class="col-form-label text-start">
                                        {{ __('Typ skupiny') }} :
                                    </label>

                                    <div class="col-md-6">
                                        <div>

                                            <label class="form-check-label text-black-50">
                                                @if($group[0]->type == 'teachers')
                                                    Skupina učitelů
                                                @else
                                                    Skupina žáků
                                                @endif
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="name" class="col-form-label text-start">
                                        {{ __('Název') }} :
                                    </label>

                                    <div class="col-md-11">
                                        <label class="form-check-label text-black-50">
                                            <?php echo $group[0]->name ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="description" class="col-form-label text-start">
                                        {{ __('Popis') }} :
                                    </label>

                                    <div class="col-md-11">
                                        <label class="form-check-label text-black-50">
                                            <?php echo $group[0]->description ?>
                                        </label>
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="owner" class="col-form-label text-start">
                                        {{ __('Správce skupiny') }} :
                                    </label>

                                    <div class="col-md-11">
                                        <label class="form-check-label text-black-50">
                                            <?php echo $group_owner[0]->degree_front ?>
                                            <?php echo $group_owner[0]->first_name ?>
                                            <?php echo $group_owner[0]->last_name ?>
                                            <?php echo $group_owner[0]->degree_after ?>

                                        </label>
                                    </div>
                                </div>
                            </div>

                                <div class="col-5">
                                    <!-- Second column -->
                                    <div class="row">
                                        <div class="row col-lg-5">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex px-0" style="aspect-ratio : 1 / 1; width: 100%; object-fit: cover;" alt="Avatar"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <div class="col-md-12 my-5">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row row-cols-2">
                                        <div>
                                            {{ __('Členové') }}
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="input-group mb-3">
                                                <input type="hidden" id="group_id" value="{{ $group[0]->id }}">
                                                <input type="hidden" id="group_type" value="{{ $group[0]->type }}">
                                                <input type="text" class="form-control" placeholder="Vyhledat člena" id="search-member">                                                </div>
                                        </div>
                                    </div>
                                    <div id="members_table">
                                    </div>
                                </div>
                            </div>
                            @if($group[0]->type == 'students')
                                <div class="card mt-5">
                                    <div class="card-header">
                                        {{__('Zadaná cvičení')}}
                                    </div>
                                    <div id="assignedExercisesBody" name="assignedExercisesBody" class="card-body" style="max-height: 10000px; overflow-y: scroll;">
                                        @foreach($exercises as $exercise)
                                        <div class="card mt-2">
                                            <div class="card-header d-flex align-items-center">
                                                <div>
                                                    {{$exercise->name}}
                                                </div>
                                                @if(Auth::id() == $group[0]->owner)
                                                    <div class="ms-auto">
                                                        <button type="submit" class="btn btn-outline-danger" onclick="unassignExercise({{$exercise->id}}, {{$group[0]->id}})">Zrušit zadání</button>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="card-body">
                                                <p class="mb-0">Počet kartiček: {{$exercise->pocet}}</p>
                                                <p class="mb-0">Téma: {{$exercise->topic}}</p>
                                                <hr class="my-2">
                                                <div class="mb-2">Popis:</div>
                                                <p class="card-text">{{$exercise->description}}</p>
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
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        /*
         * Event handler for setting the window location for the clickable row.
         * Author: David Chocholaty
         */
        $(document).on("click", ".clickable-row", function() {
            window.location = $(this).data("href");
        });
    </script>
    <script>
        /*
         * Event handler for searching the group member.
         * Author: David Chocholaty
         */
        $('#search-member').on('keyup', function(){
            searchMember();
        });

        searchMember();

        /*
         * Function for searching the group member.
         * Author: David Chocholaty
         */
        function searchMember() {
            let keyword = $('#search-member').val();
            let group_id = $('#group_id').val();
            let group_type = $('#group_type').val();

            $.post('{{ route("show-group.search-member") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword: keyword,
                    group_id: group_id,
                    group_type: group_type
                },
                function (data) {
                    table_post_row_member(data, keyword);
                });
        }

        /*
         * Function for showing the table row.
         * Author: David Chocholaty
         */
        function table_post_row_member(res, keyword) {
            let htmlView = '';

            if(res.result.length <= 0 && keyword === '') {
                document.getElementById("search-member").style.display = "none";

                htmlView += `
                <div style="height: 336px;overflow-y: scroll;">
                    <table class="table table-striped d-table">
                        <thead class="table-head-sticky">
                            <tr>
                                <div class="my-5">
                                    <div class="text-center">
                                        Skupina zatím neobsahuje žádné členy.
                                    </div>
                                </div>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>`;
            } else {
                document.getElementById("search-member").style.display = "flex";

                htmlView += `
                <div style="height: 300px;overflow-y: scroll;">
                    <table class="table table-striped d-table">
                        <thead class="table-head-sticky">
                        <tr>
                            @if(!$members->isEmpty())
                                <th>Pořadí</th>
                                <th>Foto</th>

                                @if($group[0]->type == 'teachers')
                                <th>Tituly před</th>
                                @endif

                                <th>Jméno</th>
                                <th>Příjmení</th>

                                @if($group[0]->type == 'teachers')
                                <th>Tituly za</th>
                                @endif

                                <th>Typ uživatele</th>
                                @endif
                                </tr>
                                </thead>
                                <tbody>`;

                if (res.result.length <= 0) {
                    htmlView += `
                    <tr>`
                    @if($group[0]->type == 'teachers')
                        htmlView += `<td colspan="7">`;
                    @else
                        htmlView += `<td colspan="5">`;
                    @endif
                        htmlView += `Nebyli nalezeni žádní členové.</td>
                    </tr>`;
                }

                for(let i = 0; i < res.result.length; i++){
                    var account_type = res.result[i].account_type;

                    if (account_type === "teacher") {
                        if (res.result[i].degree_front === null) {
                            res.result[i].degree_front = '';
                        }
                        if (res.result[i].degree_after === null) {
                            res.result[i].degree_after = '';
                        }
                    }

                    var url = '{{ route("profile", ":id") }}';
                    url = url.replace(':id', res.result[i].id);

                    htmlView += `
                        <tr class="clickable-row-hover" style="cursor:pointer;">
                            <td class="clickable-row" data-href="` + url + `">`+ (i+1) +`</td>
                            <td class="clickable-row" data-href="` + url + `">
                                <img src="` + res.result[i].photo + `" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                    alt="Avatar"/>
                            </td>`;

                    if (account_type === 'teacher') {
                        htmlView += `
                            <td class="clickable-row" data-href="` + url + `">`+res.result[i].degree_front+`</td>`;
                    }

                    htmlView += `
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].first_name+`</td>
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].last_name+`</td>`;

                    if (account_type === 'teacher') {
                        htmlView += `
                            <td class="clickable-row" data-href="` + url + `">`+ res.result[i].degree_after  +`</td>`;
                    }

                    htmlView += `
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].account_type+`</td>
                        </tr>`;
                }

                htmlView += `</tbody></table></div>`;
            }

            $('#members_table').html(htmlView);
        }
    </script>
    <script>
        /*
         * Setting window location for the clickable row.
         * Author: Simon Vacek
         */
        jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });

        /*
         * Function for unassigning the exercise.
         * Author: Simon Vacek
         */
        function unassignExercise(exerciseID, groupId) {
            $.post('{{route('mygroups.unassign-exercise')}}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                group_id: groupId,
                exercise_id: exerciseID
            });
            loadAssignedExercises(groupId);
        }

        /*
         * Function for loading the assigned exercises.
         * Author: Simon Vacek
         */
        function loadAssignedExercises(groupId) {
            if('{{$group[0]->type}}' === 'students') {
                $.post('{{route('mygroups.get-assignments')}}', {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    group_id: groupId
                }, function (data) {
                    postAssignments(data);
                });
            }
        }

        /*
         * Function for post assignments.
         * Author: Simon Vacek
         */
        function postAssignments(data) {
            let htmlView = ``;
            for(let i = 0; i < data.length; i++) {
                htmlView += `
                    <div class="card mt-2">
                        <div class="card-header d-flex align-items-center">
                            <div>` + data[i].name + `</div>
                            <div class="ms-auto">
                                <button type="submit" class="btn btn-outline-danger" onclick="unassignExercise(` + data[i].id + `, ` + data[i].id + `)">
                                    Zrušit zadání
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="mb-0">Počet kartiček: ` + data[i].pocet + `</p>
                            <p class="mb-0">Téma: ` + data[i].topic + `</p>
                            <hr class="my-2">
                            <div class="mb-2">Popis:</div>
                            <p class="card-text">` + data[i].description + `</p>
                        </div>
                    </div>
                `
            }
            $('#assignedExercisesBody').html(htmlView);
        }
    </script>

@endsection
