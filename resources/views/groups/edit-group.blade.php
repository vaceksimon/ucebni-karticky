@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Úprava skupiny') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('edit-group.store') }}">
                            @csrf

                            <input type="hidden" name="group_id" value="<?php echo $group[0]->id; ?>">


                            <div class="row row-center row-cols-2">
                                <div>
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
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Viditelnost') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="visibility" id="private" value="private"
                                                        {{ $group[0]->visibility == 'public' ? '' : 'checked' }}>
                                                    <label for="private" class="form-check-label">
                                                        Soukromá skupina
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="visibility" id="public" value="public"
                                                        {{ $group[0]->visibility == 'public' ? 'checked' : '' }}>
                                                    <label for="private" class="form-check-label">
                                                        Veřejná skupina
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <!-- Second column -->
                                    <div class="row row-center row-cols-2">
                                        <div class="row row-center" style="width: 40%">
                                            <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle d-flex px-0"
                                                 alt="Avatar"/>
                                        </div>
                                        <div class="row row-center" style="width: 60%">
                                            <div class="container my-auto">
                                                <label class="input-group-text my-auto" style="width: 75px" for="inputGroupFile">Upravit</label>
                                                <input type="file" class="form-control" id="inputGroupFile" hidden>
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
                                           name="name" value="<?php echo $group[0]->name ?>" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="description" class="col-form-label text-start">
                                    {{ __('Popis') }} :
                                </label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                              required autocomplete="description" autofocus><?php echo $group[0]->description ?></textarea>
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
                                                <button type="button" class="btn btn-outline-primary btn-sm px-3 ms-auto me-0" style="width: 120px" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
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
                                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
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
                                                                <form method="post" action="{{ route('edit-group.remove-member') }}">
                                                                    @csrf

                                                                    <input type="hidden" id="member_id" name="member_id" value="{{ $member->user_id }}">
                                                                    <input type="hidden" id="group_id" name="group_id" value="{{ session('group_id') }}">
                                                                    <button type="submit" class="btn btn-outline-danger">Odebrat</button>
                                                                </form>
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
                                  - vytvořit skupinu will navigate to moje skupiny page
                                 -->
                                <button class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                <button type="submit" class="btn btn-primary btn-lg px-3 ms-auto me-0">Vytvořit skupinu</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Přidání uživatele</h5>
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
                                                            <input type="text" class="form-control" placeholder="Vyhledat uživatele" id="search">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <div style="height: 300px;overflow-y: scroll;">
                                                <table id="users_table" class="table table-striped d-table">
                                                    <thead>
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
                                                    <tbody>
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
            $.post('{{ route("edit-group.search") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword
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
                <td colspan="4">Nebyli nalezeni žádní uživatelé.</td>
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
                    <form method="post" action="">
                        @csrf

                        <input type="hidden" name="member_id" value="`+ res.result[i].id +`">
                        <button type="submit" class="btn btn-outline-primary">Přidat</button>
                    </form>
                </td>
</tr>`;
            }
            $('#users_table').html(htmlView);
        }
    </script>
@endsection
