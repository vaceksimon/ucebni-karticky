@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Vytvoření skupiny') }}
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('create-group') }}">
                            @csrf

                            <div class="row row-center row-cols-2">
                                <div>
                                    <div class="mb-3 row row-center">
                                        <label for="" class="col-form-label text-start">
                                            {{ __('Typ skupiny') }} :
                                        </label>

                                        <div class="col-md-6">
                                            <div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="type" id="students" value="students"
                                                        {{ old('type') == 'teachers' ? '' : 'checked' }}>
                                                    <label for="students" class="form-check-label">
                                                        Skupina žáků
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="type" id="teachers" value="teachers"
                                                        {{ old('type') == 'teachers' ? 'checked' : '' }}>
                                                    <label for="teachers" class="form-check-label">
                                                        Skupina učitelů
                                                    </label>
                                                </div>
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
                                                        {{ old('visibility') == 'public' ? '' : 'checked' }}>
                                                    <label for="private" class="form-check-label">
                                                        Soukromá skupina
                                                    </label>
                                                </div>
                                                <div>
                                                    <input type="radio"
                                                           class="form-check-input"
                                                           name="visibility" id="public" value="public"
                                                        {{ old('visibility') == 'public' ? 'checked' : '' }}>
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
                                           name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                </div>
                            </div>

                            <div class="mb-3 row row-center">
                                <label for="description" class="col-form-label text-start">
                                    {{ __('Popis') }} :
                                </label>

                                <div class="col-md-6">
                                    <textarea rows="5" cols="60" id="description" name="description" class="form-control" style="height:20vh;"
                                              required autocomplete="description" autofocus>
                                    </textarea>
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
                                        <div class="text-center">
                                            Vaše skupina zatím neobsahuje žádné členy.
                                        </div>
                                        <div class="row row-center mx-auto my-3" style="width: 120px">
                                            <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#exampleModal">Přidat člena</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3 d-flex">
                                <button class="btn btn-outline-secondary btn-lg px-4 gap-3">Zrušit</button>
                                <button class="btn btn-primary btn-lg px-3 ms-auto me-0">Vytvořit skupinu</button>
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
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="input-group mb-3">
                                                            <input type="text" class="form-control"   placeholder="Vyhledat uživatele" id="search">
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <table class="table table-striped table-inverse table-responsive d-table">
                                                <thead>
                                                <tr>
                                                    <th>Pořadí</th>
                                                    <th>Jméno</th>
                                                    <th>Příjmení</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <!--

                            <div class="row row-center">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Fotografie</th>
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






                        -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
<!--    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->

    <script>$('#search').on('keyup', function(){    search();});search();
        function search(){
            var keyword = $('#search').val();
            $.post('{{ route("create-group.search") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword
                },
                function(data){
                table_post_row(data);
                console.log(data);
            });}
        // table row with ajax
        function table_post_row(res){
            let htmlView = '';
            if(res.result.length <= 0){
                htmlView += `
                    <tr>
                        <td colspan="4">No data.</td>
                    </tr>`;
            }
            for(let i = 0; i < res.result.length; i++){
                htmlView +=
                    `        <tr>           <td>`+ (i+1) +`</td>              <td>`+res.result[i].first_name+`</td>               <td>`+res.result[i].last_name+`</td>        </tr>`;}     $('tbody').html(htmlView);}</script>
@endsection
