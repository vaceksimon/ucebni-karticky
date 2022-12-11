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
                                    <div class="row">
                                        <div class="row col-lg-5">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex my-lg-auto mx-lg-0 my-3 mx-auto px-0" style="aspect-ratio : 1 / 1; width: 100%; object-fit: cover;" id="img_group" alt="Avatar"/>
                                        </div>
                                        <div class="row col-lg-7">
                                            <div class="container my-auto">
                                                <label class="input-group-text my-lg-auto change-image mx-lg-0 my-3 mx-auto" style="width: 75px; cursor:pointer;" for="image">Upravit</label>
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
                                                <button type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div style="height: 300px;overflow-y: scroll;">
                                            <table class="table table-striped">
                                                <thead>
                                                </thead>

                                                @empty($members[0])
                                                    <tbody>
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
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                    @foreach($members as $member)
                                                        <tr>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                <img src="{{ $member->photo }}" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                                                     alt="Avatar"/>
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->degree_front }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->first_name }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->last_name }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->degree_after }}
                                                            </td>
                                                            <td>
                                                                <button type="button"
                                                                        class="btn btn-outline-danger open-remove-member-dialog"
                                                                        data-id="{{ $member->user_id }}"
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
                                <label for="delete-group" class="col-form-label text-start" style="color: red">
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
                                <a
                                @if((Auth::user()->account_type != "admin"))
                                    href="{{ route('mygroups') }}"
                                @else
                                    href="{{ route('group-administration') }}"
                                @endif
                                >
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
                                            <form action="" method="POST">
                                                @csrf

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <input type="hidden" id="group_id" value="{{ $group[0]->id }}">
                                                            <input type="hidden" id="group_type" name="group_type" value="{{ $group[0]->type }}">
                                                            <input type="text" class="form-control" placeholder="Vyhledat uživatele" id="search">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                                <div style="height: 300px;overflow-y: scroll;">
                                                    <table class="table table-striped d-table">
                                                        <thead class="table-head-sticky">
                                                        <tr>
                                                            <th>Pořadí</th>
                                                            <th>Foto</th>
                                                            <th>Tituly před</th>
                                                            <th>Jméno</th>
                                                            <th>Příjmení</th>
                                                            <th>Tituly za</th>
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
                            <form method="post" action="{{ route('edit-group.remove-member') }}">
                                @csrf

                                <input type="hidden" id="member_id" name="member_id" value="">
                                <input type="hidden" id="group_id" name="group_id" value="{{ session('group_id') }}">
                                <input type="hidden" id="group_name" name="group_name" value="">
                                <input type="hidden" id="group_description" name="group_description" value="">
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
    <script>$('#search').on('keyup', function(){
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
                    console.log(data);
                });
        }
        // table row with ajax
        function table_post_row(res){
            let htmlView = '';
            if(res.result.length <= 0){
                htmlView += `
            <tr>
                <td colspan="8">Nebyli nalezeni žádní uživatelé.</td>
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
                </td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].degree_front+`</td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].first_name+`</td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].last_name+`</td>
                <td class="clickable-row" data-href="` + url + `">`+ res.result[i].degree_after  +`</td>
                <td class="clickable-row" data-href="` + url + `">`+res.result[i].account_type+`</td>
                <td>
                    <form method="post" action="{{ route('edit-group.add-member') }}">
                        @csrf

                        <input type="hidden" name="new_user_id" value="`+ res.result[i].id +`">
                        <input type="hidden" id="new_user_group_id" name="new_user_group_id" value="{{ session('group_id') }}">
                        <button type="submit" class="btn btn-outline-primary">Přidat</button>
                    </form>
                </td>
            </tr>`;

            }
            $('#users_table').html(htmlView);
        }
    </script>
    <script>
        // https://stackoverflow.com/questions/10626885/passing-data-to-a-bootstrap-modal
        $(document).on("click", ".open-remove-member-dialog", function () {
            var member = $(this).data('id');
            var groupName = document.getElementById("name").value;
            var groupDescription = document.getElementById("description").value;

            $(".modal-footer #member_id").val( member );
            $(".modal-footer #group_name").val( groupName );
            $(".modal-footer #group_description").val( groupDescription );
        });
    </script>

    <script>
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

@endsection
