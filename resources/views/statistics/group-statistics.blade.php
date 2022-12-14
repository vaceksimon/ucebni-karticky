<!-- ************************************* -->
<!-- * Author: Simon Vacek               * -->
<!-- * Login: xvacek10                   * -->
<!-- ************************************* -->

@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        {{__('Statistiky cvičení')}}
                    </div>
                    <div class="card-body">
                        <div class="card-group">
                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div>
                                        Cvičení: {{$exercise->name}}
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{route('myexercises')}}" style="text-decoration: none">
                                            <button class="btn btn-outline-secondary">Zpět na cvičení</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row mb-1">
                                        Téma: {{$exercise->topic}}
                                    </div>
                                    <div class="row mb-1">
                                        Počet kartiček: {{$exercise->count}}
                                    </div>
                                    <div class="row mb-1">
                                        Popis: {{$exercise->description}}
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-3">
                                <div class="card-header d-flex align-items-center">
                                    <div>
                                        Skupina: {{$group->name}}
                                    </div>
                                    <div class="ms-auto">
                                        <a href="{{route('mygroups')}}" style="text-decoration: none">
                                            <button class="btn btn-outline-secondary">Zpět na skupiny</button>
                                        </a>
                                    </div>
                                </div>
                                <div class="card-body row">
                                    <div class="col-9">
                                        Popis: {{$group->description}}
                                    </div>
                                    <div class="col-3">
                                        <img src="{{asset($group->photo)}}" class="rounded-circle"
                                             style="width: 60px; height: 60px;" alt="Fotka skupiny"/>
                                    </div>
                                    <form method="POST" action="{{route('mygroups.clickShow')}}">
                                        @csrf
                                        <input id="group_id" name="group_id" value="{{$group->id}}" hidden/>
                                        <input type="submit" class="btn btn-outline-primary" value="Zobrazit skupinu"/>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @empty($best_attempt[0])
                            <div class="text-center my-5">
                                <h4>
                                    Toto cvičení zatím nebylo dokončeno.
                                    <i class="bi bi-emoji-frown"></i>
                                </h4>
                            </div>
                        @else
                            <hr class="my-2">

                            <div class="card-group mt-3">
                                <div class="col-5 card">
                                    <div class="card-header">Nejúspěšnější pokusy</div>
                                    <div class="card-body">
                                        @foreach($best_attempt as $attempt)
                                            <div class="card mb-2">
                                                <div class="card-body p-1">
                                                    <p>Čas: {{$attempt->spend_time}}</p>
                                                    <p>Úspěšnost: {{money_format('%.0i', $attempt->percentage)}}%</p>
                                                    <p class="text-success">Počet správných
                                                        odpovědí: {{$attempt->correct_answers_number}}</p>
                                                    <p class="text-danger m-0">Počet špatných
                                                        odpovědí: {{$attempt->wrong_answers_number}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-5 card">
                                    <div class="card-header">Nejrychlejší pokusy</div>
                                    <div class="card-body">
                                        @foreach($fastest_attempt as $attempt)
                                            <div class="card mb-2">
                                                <div class="card-body p-1">
                                                    <p>Čas: {{$attempt->spend_time}}</p>
                                                    <p>Úspěšnost: {{money_format('%.0i', $attempt->percentage)}}%</p>
                                                    <p class="text-success">Počet správných
                                                        odpovědí: {{$attempt->correct_answers_number}}</p>
                                                    <p class="text-danger m-0">Počet špatných
                                                        odpovědí: {{$attempt->wrong_answers_number}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="my-5">
                                <div class="mb-3 text-center">
                                    <b>Souhrnný graf</b>
                                </div>
                                <div class="card chart-container">
                                    <canvas id="chart"><!-- Chart data --></canvas>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    Zobrazit statistiku žáka
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" placeholder="Vyhledat žáka" id="search-student">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="students_table">
                                        <!-- members of the group -->
                                    </div>
                                </div>
                            </div>
                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
        The following part of code is inspired from the source on 2022-11-25:
        - Source: https://www.devwares.com/blog/create-bootstrap-charts-using-bootstrap5/
        - Author: By Chimdia Anyiam
    -->
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/cdb.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cdbootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/9d1d9a82d2.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script>

    <script>
        // chart
        const ctx = document.getElementById("chart").getContext('2d');
        var chartData = {{ json_encode($chart_data) }};
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ["0%", "10%", "20%", "30%", "40%",
                    "50%", "60%", "70%", "80%", "90%", "100%"],
                datasets: [{
                    label: 'Úspěšnost',
                    backgroundColor: 'rgba(161, 198, 247, 1)',
                    borderColor: 'rgb(47, 128, 237)',
                    data: chartData,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {if (value % 1 === 0) {return value;}}
                        },
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Počet pokusů'
                        }
                    }]
                }
            },
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
        $(document).on("click", ".clickable-row", function() {
            window.location = $(this).data("href");
        });
    </script>

    <script>
        $('#search-student').on('keyup', function(){
            searchStudent();
        });

        searchStudent();

        /*
         * Sends post http request and retrieves student based on their name.
         */
        function searchStudent(){
            let keyword = $('#search-student').val();
            let group_id = $('#group_id').val();
            let user_type = "student";

            $.post('{{ route("group-statistics.search-student") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    keyword:keyword,
                    group_id:group_id,
                    user_type:user_type
                },
                function(data){
                    table_post_row_student(data, keyword);
                });
        }

        /*
         * Prints students in a group to div students_table.
         */
        function table_post_row_student(res, keyword){
            let htmlView = '';

            if(res.result.length <= 0 && keyword === '') {
                document.getElementById("search-student").style.display = "none";

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
                document.getElementById("search-student").style.display = "flex";

                htmlView += `
                    <div style="height: 300px;overflow-y: scroll;">
                        <table class="table table-striped d-table">
                            <thead class="table-head-sticky">
                            <tr>
                                @if(!$members->isEmpty())
                                <th>Pořadí</th>
                                <th>Foto</th>
                                <th>Jméno</th>
                                <th>Příjmení</th>
                                <th>Zobrazit statistiku</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>`;

                if (res.result.length <= 0) {
                    htmlView += `<tr><td colspan="6">Nebyli nalezeni žádní žáci.</td></tr>`;
                }

                for(let i = 0; i < res.result.length; i++){
                    var url = '{{ route("profile", ":id") }}';
                    url = url.replace(':id', res.result[i].id);

                    htmlView += `
                    <tr class="clickable-row-hover" style="cursor:pointer;">
                        <td class="clickable-row" data-href="` + url + `">`+ (i+1) +`</td>
                        <td class="clickable-row" data-href="` + url + `">
                            <img src="` + res.result[i].photo + `" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                alt="Avatar"/>
                        </td>
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].first_name+`</td>
                        <td class="clickable-row" data-href="` + url + `">`+res.result[i].last_name+`</td>
                        <td>
                            <form method="POST" action="{{route('myexercises.user-statistics')}}">
                                @csrf
                                <input id="user_id" name="user_id" value="` + res.result[i].id + `" hidden>
                                <input id="exercise_id_stat" name="exercise_id_stat" value="{{$exercise->id}}" hidden>
                                <input type="submit" class="btn btn-outline-primary" value="Zobrazit">
                            </form>
                        </td></tr>`;
                }

                htmlView += `</tbody></table></div>`;
            }

            $('#students_table').html(htmlView);
        }
    </script>
@endsection
