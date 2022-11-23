@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Moje cvičení') }}</div>
                    @if($role === 'teacher')
                    <div class="card-body">
                        <div class="col-md-12">
                            @foreach($t_exercises as $record)
                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div class="col-6">
                                        <div class="d-flex align-items-center gap-1">
                                            <div> {{ $record->name }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex">
                                        <div class="col-6">
                                            <div>Počet kartiček: {{ $record->pocet }}</div>
                                            <div>Téma: {{ $record->topic }}</div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex justify-content-end gap-3">
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Sdílet</button>
                                                <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" data-bs-toggle="modal" data-bs-target="#exampleModal">Zadat</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-2" />
                                    <div class="pb-3">Popis:</div>
                                    <div>{{ $record->description }}</div>
                                    <div class="d-flex pt-3 gap-2">
                                        <div class="col-8 d-flex gap-3">
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Upravit</button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit statistiky</button>
                                            <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit</button>
                                        </div>
                                        <div class="col-4 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary btn-sm px-3 me-3 text-nowrap" >Spustit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @elseif($role === 'student')
                        <div class="card-body">
                            <div class="col-md-12">
                                @foreach($s_exercises as $record)
                                    <div class="card mb-3">
                                        <div class="card-header d-flex align-items-center">
                                            <div class="col-6">
                                                <div class="d-flex align-items-center gap-1">
                                                    <div class="col-6"> {{ $record->e_name }} </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="d-flex justify-content-end">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex">
                                                <div class="col">
                                                    <div>Počet kartiček: {{ $record->count }} </div>
                                                    <div>Téma: {{ $record->topic }}</div>
                                                    <div>Skupina: {{ $record->g_name }}</div>
                                                </div>
                                            </div>
                                            <hr class="my-2" />
                                            <div class="pb-3">Popis:</div>
                                            <div> {{ $record->description }} </div>
                                            <div class="d-flex pt-3 gap-2">
                                                <div class="col-8 d-flex gap-3">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit statistiky</button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm px-3 text-nowrap" >Zobrazit</button>
                                                </div>
                                                <div class="col-4 d-flex justify-content-end">
                                                    <button type="button" class="btn btn-primary btn-sm px-3 me-3 text-nowrap" >Spustit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="--bs-modal-width: 75vw;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Zadání skupině</h5>
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
                                                    <th>Název</th>
                                                    <th>Popis</th>
                                                    <th>Foto</th>
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
            $.post('{{ route("myexercises.search") }}',
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
                <td colspan="3">No data.</td>
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
                <td>`+res.result[i].name +`</td>
                <td>`+res.result[i].description +`</td>
                <td>`+res.result[i].photo +`</td>
                <td>
                    <form method="post" action="">
                        <input type="hidden" name="member_id" value="`+ res.result[i].id +`">
                        <button type="submit" class="btn btn-outline-primary">Zadat</button>
                    </form>
                </td>
</tr>`;
            }
            $('tbody').html(htmlView);
        }
    </script>

@endsection
