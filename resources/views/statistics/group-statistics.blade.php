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
                                        <input id="group_id" name="group_id" value="{{$group->id}}" hidden />
                                        <input type="submit" class="btn btn-outline-primary" value="Zobrazit skupinu" />
                                    </form>
                                </div>
                            </div>
                        </div>


                        <hr class="my-2">

                        <div class="card-group mt-3">
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
                        </div>

                        <div class="my-5">
                            <div class="mb-3 text-center">
                                <b>Souhrnný graf</b>
                            </div>
                            <div class="card chart-container">
                                <canvas id="chart"></canvas>
                            </div>
                        </div>

                    </div>
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
                        }
                    }]
                }
            },
        });
    </script>
@endsection
