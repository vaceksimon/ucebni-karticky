@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Úprava skupiny') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit-group.store') }}" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="group_id" value="<?php echo $group[0]->id; ?>">

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
                                            {{ __('Název *') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <input id="name" type="text" class="form-control"
                                                   name="name" value="<?php echo $group[0]->name ?>" required autocomplete="name" autofocus
                                                   oninvalid="this.setCustomValidity('Prosím zadejte název skupiny')"
                                                   oninput="setCustomValidity('')">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="description" class="col-form-label text-start">
                                            {{ __('Popis') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                                      required autocomplete="description" autofocus><?php echo $group[0]->description ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <!-- Second column -->
                                    <div class="row row-cols-2">
                                        <div class="row" style="width: 40%">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex px-0" style="width: 160px; height: 160px;"
                                                 id="img_group" alt="Avatar"/>
                                        </div>
                                        <div class="row" style="width: 60%">
                                            <div class="container my-auto">
                                                <label class="input-group-text my-auto change-image" style="width: 75px; cursor:pointer;" for="image">Upravit</label>
                                                <input type="file" class="form-control" onchange="photoSelected(this)" id="image" name="image" hidden>
                                            </div>
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
                                            <div class="row">
                                                <button type="button" id="add-member-open-model-btn" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <form action="" method="POST">
                                            @csrf

                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="input-group mb-3">
                                                        <input type="text" class="form-control" placeholder="Vyhledat člena" id="search-member">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="members_table">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label class="col-form-label text-start" style="color: red">
                                    <b>{{ __('Nebezpečná zóna') }}</b> :
                                </label>

                                <div class="pb-5">
                                    <button id="delete-group"
                                            type="button"
                                            class="btn btn-outline-danger px-4 gap-3"
                                            data-id="{{ session('group_id') }}"
                                            data-bs-toggle="modal"
                                            data-bs-target="#deletingQuestion">Zrušit skupinu</button>
                                </div>
                            </div>

                            <div class="my-3 d-flex">
                                <a href="{{ url()->previous() }}">
                                    <input type="button" class="btn btn-outline-secondary btn-lg px-4 gap-3" value="Zrušit">
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg px-3 ms-auto me-0">Upravit skupinu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="addMemberModal" name="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true" style="--bs-modal-width: 75vw;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addMemberModalLabel">Přidání uživatele</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mt-5">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="input-group mb-3">
                                                        <input type="hidden" id="group_id" value="{{ $group[0]->id }}">
                                                        <input type="hidden" id="group_type" name="group_type" value="{{ $group[0]->type }}">
                                                        <input type="text" class="form-control" placeholder="Vyhledat uživatele" id="search">
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="height: 300px;overflow-y: scroll;">
                                                <table class="table table-striped d-table">
                                                    <thead class="table-head-sticky">
                                                    <tr>
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
                                                        <th>Akce</th>
                                                    </tr>
                                                    </thead>
                                                        <tbody id="users_table">
                                                        </tbody>
                                                </table>
                                            </div>
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

            <div id="removingQuestion" class="modal fade" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upozornění</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Opravdu si přejete odebrat uživatele ze skupiny?</p>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="member_id" name="member_id" value="">
                            <input type="hidden" id="group_id" name="group_id" value="{{ session('group_id') }}">
                            <button type="button" class="btn btn-primary" id="remove-member-btn" data-bs-dismiss="modal" value="">Ano</button>
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
                            <p>Opravdu si přejete zrušit skupinu?</p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="{{ route('edit-group.delete-group') }}">
                                @csrf

                                <input type="hidden" id="group_id" name="group_id" value="{{ session('group_id') }}">
                                <button type="submit" class="btn btn-danger">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
    The following part of code is inspired of the source:
    - Source: https://medium.com/@cahyofajar28/live-search-in-laravel-8-using-ajax-and-mysql-ac4bc9b0a93c
    - Author: Cahyo Fajar
    -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".clickable-row", function() {
            window.location = $(this).data("href");
        });
    </script>
    <script>
        $('#search').on('keyup', function(){
            search();
        });

        search();

        function search(){
            var keyword = $('#search').val();
            var group_id = $('#group_id').val();
            var group_type = $('#group_type').val();

            $.post('{{ route("edit-group.search") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword,
                    group_id:group_id,
                    group_type:group_type
                },
                function(data){
                    table_post_row(data);
                });
        }
        // table row
        function table_post_row(res){
            let htmlView = '';
            if(res.result.length <= 0){
                htmlView += `
                    <tr>`
                            @if($group[0]->type == 'teachers')
                                htmlView += `<td colspan="8">`;
                            @else
                                htmlView += `<td colspan="6">`;
                            @endif

                            htmlView += `Nebyli nalezeni žádní uživatelé.</td>
                    </tr>`;
            }

            for(let i = 0; i < res.result.length; i++){
                if (res.result[i].degree_front === null) {
                    res.result[i].degree_front = '';
                }
                if (res.result[i].degree_after === null) {
                    res.result[i].degree_after = '';
                }

                var url = '{{ route("profile", ":id") }}';
                url = url.replace(':id', res.result[i].id);

                htmlView += `
                    <tr>
                        <td class="clickable-row" data-href="` + url + `">`+ (i+1) +`</td>
                        <td class="clickable-row" data-href="` + url + `">
                            <img src="` + res.result[i].photo + `" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                alt="Avatar"/>
                        </td>`;

                @if($group[0]->type == 'teachers')
                    htmlView += `<td class="clickable-row" data-href="` + url + `">`+res.result[i].degree_front+`</td>`;
                @endif

                htmlView += `
                    <td class="clickable-row" data-href="` + url + `">`+res.result[i].first_name+`</td>
                    <td class="clickable-row" data-href="` + url + `">`+res.result[i].last_name+`</td>`;

                @if($group[0]->type == 'teachers')
                    htmlView += `<td class="clickable-row" data-href="` + url + `">`+ res.result[i].degree_after  +`</td>`;
                @endif

                htmlView += `
                    <td class="clickable-row" data-href="` + url + `">`+res.result[i].account_type+`</td>
                    <td>
                        <input type="hidden" id="new_user_group_id" name="new_user_group_id" value="{{ session('group_id') }}">
                        <button type="button" class="btn btn-outline-primary" id="add-member-btn"  data-id="` + res.result[i].id + `">Přidat</button>
                    </td>
                </tr>`;
            }

            $('#users_table').html(htmlView);
        }
    </script>
    <script>
        $(document).on("click", "#add-member-btn", function () {
            addMember($(this).data("id"),
                document.getElementById("new_user_group_id").value);
        });

        function addMember(new_user_id, new_user_group_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data: {"new_user_id": new_user_id, "new_user_group_id": new_user_group_id},
                url: "{{ route('edit-group.add-member') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '1') {
                        alert("Nepodařilo se přidat člena.");
                    }
                },
                error: function (data) {
                    console.log('Error: ', data);
                },
            });

            // Clear the searching text field.
            document.getElementById('search').value = '';
            // Search to remove the deleted row.
            search();
            searchMember();
        }
    </script>
    <script>
        $(document).on("click", ".open-remove-member-dialog", function () {
            var member = $(this).data('id');

            $(".modal-footer #member_id").val( member );
        });
    </script>

    <script>
        searchMember();

        function searchMember(){
            var keyword = $('#search-member').val();
            var group_id = $('#group_id').val();
            var group_type = $('#group_type').val();

            $.post('{{ route("edit-group.search-member") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword,
                    group_id:group_id,
                    group_type:group_type
                },
                function(data){
                    table_post_row_member(data, keyword);
                });
        }

        // table row
        function table_post_row_member(res, keyword){
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
                                            Vaše skupina zatím neobsahuje žádné členy.
                                        </div>
                                        <div class="row mx-auto my-3" style="width: 120px">
                                            <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
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
                                <th>Akce</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>`;

                if (res.result.length <= 0) {
                    htmlView += `
                        <tr>`
                                @if($group[0]->type == 'teachers')
                                    htmlView += `<td colspan="8">`;
                                @else
                                    htmlView += `<td colspan="6">`;
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
                    <tr>
                        <td class="clickable-row" data-href="` + url + `">`+ (i+1) +`</td>
                        <td class="clickable-row" data-href="` + url + `">
                            <img src="` + res.result[i].photo + `" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                alt="Avatar"/>
                        </td>`;

                    if (account_type === 'teacher') {
                        htmlView += `
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].degree_front+`</td>
                    `;
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
                    <td>
                        <button type="button" class="btn btn-outline-danger open-remove-member-dialog"
                            data-id="` + res.result[i].id + `" data-bs-toggle="modal" data-bs-target="#removingQuestion">Odebrat</button>
                    </td></tr>`;
                }

                htmlView += `</tbody></table></div>`;
            }

            $('#members_table').html(htmlView);
        }

        $('#search-member').on('keyup', function(){
            searchMember();
        });
    </script>
    <script>
        $(document).on("click", "#remove-member-btn", function () {
            removeMember(document.getElementById("member_id").value,
                document.getElementById("group_id").value);
        });

        function removeMember(member_id, group_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                data: {"member_id": member_id, "group_id": group_id},
                url: "{{ route('edit-group.remove-member') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data === '1') {
                        alert("Nepodařilo se odebrat člena.");
                    }
                },
                error: function (data) {
                    console.log('Error: ', data);
                },
            });

            // Clear the searching text field.
            document.getElementById('search-member').value = '';
            // Search to remove the deleted row.
            searchMember();
        }
    </script>
    <script>
        $("input[name='image']").change(function() { this.form.submit(); });

        function photoSelected(profilePhoto) {
            let url = profilePhoto.value;
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (profilePhoto.files && profilePhoto.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_group').attr('src', e.target.result);
                }
                reader.readAsDataURL(profilePhoto.files[0]);
            }
        }
    </script>
    <script>
        $(document).on("click", "#add-member-open-model-btn", function () {
            document.getElementById('search').value = '';
            search();
        });
    </script>

@endsection
