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

                            <div class="row row-center">
                                <div class="col-7">
                                    <div class="mb-3 row row-center">
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

                                    <div class="mb-3 row row-center">
                                        <label for="name" class="col-form-label text-start">
                                            {{ __('Název *') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <input id="name" type="text" class="form-control"
                                                   name="name" value="<?php echo $group[0]->name ?>" required autocomplete="name" autofocus>
                                        </div>
                                    </div>

                                    <div class="mb-3 row row-center">
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
                                    <div class="row row-center row-cols-2">
                                        <div class="row row-center" style="width: 40%">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex px-0"
                                                 alt="Avatar"/>
                                        </div>
                                        <div class="row row-center" style="width: 60%">
                                            <div class="container my-auto">
                                                <label class="input-group-text my-auto" style="width: 75px; cursor:pointer;" for="image">Upravit</label>
                                                <input onchange="this.form.submit();" type="file" class="form-control" id="image" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 my-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row row-center row-cols-2">
                                            <div>
                                                {{ __('Členové') }}
                                            </div>
                                            <div class="row row-center">
                                                <button type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div style="height: 300px;overflow-y: scroll;">
                                            <table class="table table-striped">
                                                <thead>
                                                </thead>
                                                @empty($members)
                                                    <div class="text-center">
                                                        Vaše skupina zatím neobsahuje žádné členy.
                                                    </div>
                                                    <div class="row row-center mx-auto my-3" style="width: 120px">
                                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
                                                    </div>
                                                @else
                                                    <tbody>
                                                    @foreach($members as $member)
                                                        <tr>
                                                            <td>{{ $member->degree_front }}</td>
                                                            <td>{{ $member->first_name }}</td>
                                                            <td>{{ $member->last_name }}</td>
                                                            <td>{{ $member->degree_after }}</td>
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

                            <div class="my-3 d-flex">
                                <a href="{{ route('mygroups') }}">
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
                                                    <thead style="position: sticky; top: 0; z-index: 1; background-color: lightgrey;">
                                                    <tr>
                                                        <th>Pořadí</th>
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
                                <button type="submit" class="btn btn-primary">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- https://medium.com/@cahyofajar28/live-search-in-laravel-8-using-ajax-and-mysql-ac4bc9b0a93c -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    <!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->

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
                <td colspan="7">Nebyli nalezeni žádní uživatelé.</td>
            </tr>`;
            }
            for(let i = 0; i < res.result.length; i++){
                if (res.result[i].degree_front === null) {
                    res.result[i].degree_front = '';
                }
                if (res.result[i].degree_after === null) {
                    res.result[i].degree_after = '';
                }
                htmlView += `
            <tr>
                <td>`+ (i+1) +`</td>
                <td>`+res.result[i].degree_front+`</td>
                <td>`+res.result[i].first_name+`</td>
                <td>`+res.result[i].last_name+`</td>
                <td>`+ res.result[i].degree_after  +`</td>
                <td>`+res.result[i].account_type+`</td>
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
            $(".modal-footer #member_id").val( member );
        });
    </script>
    <script>
        $("input[name='image']").change(function() { this.form.submit(); });
    </script>
@endsection
