@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Statistiky cvičení') }}
                    </div>

                    <div class="card-body">
                        <div class="mt-1 mb-3">
                            <div class="mb-1">
                                <b>Základní informace:</b>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <b>Cvičení</b>: <?php echo $exercise_name ?>
                                    </li>
                                    <!-- TODO user -->
                                    @if($user_id != Auth::user()->id)
                                        <b>Uživatel:</b>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        @empty($most_successful_attempt[0])
                            <div class="text-center my-5">
                                <h4>
                                    Dané cvičení zatím nebylo dokončeno.
                                    <i class="bi bi-emoji-frown"></i>
                                </h4>
                            </div>
                        @else
                        <div class="my-5">
                            <div class="mb-1">
                                <b>Nejrúspěšnější pokus</b>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <b>Datum:</b> {{ $most_successful_attempt[0]->created_at }}
                                    </li>
                                    <li>
                                        <b>Čas:</b> {{ $most_successful_attempt[0]->spend_time }}
                                    </li>
                                    <li>
                                        <b>Úspěšnost:</b> {{ floor($most_successful_attempt[0]->success_rate) }} %
                                        <ul>
                                            <li>
                                                Počet otázek: {{
                                                $most_successful_attempt[0]->correct_answers_number +
                                                $most_successful_attempt[0]->wrong_answers_number }}
                                            </li>
                                            <li style="color: green">
                                                Správně: {{ $most_successful_attempt[0]->correct_answers_number }}
                                            </li>
                                            <li style="color: red">
                                                Špatně: {{ $most_successful_attempt[0]->wrong_answers_number }}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="my-5">
                            <div class="mb-1">
                                <b>Nejrychlejší pokus</b>
                            </div>
                            <div>
                                <ul>
                                    <li>
                                        <b>Datum:</b> {{ $fastest_attempt[0]->created_at }}
                                    </li>
                                    <li>
                                        <b>Čas:</b> {{ $fastest_attempt[0]->spend_time }}
                                    </li>
                                    <li>
                                        <b>Úspěšnost:</b> {{ floor($fastest_attempt[0]->success_rate) }} %
                                        <ul>
                                            <li>
                                                Počet otázek: {{
                                                $fastest_attempt[0]->correct_answers_number +
                                                $fastest_attempt[0]->wrong_answers_number }}
                                            </li>
                                            <li style="color: green">
                                                Správně: {{ $fastest_attempt[0]->correct_answers_number }}
                                            </li>
                                            <li style="color: red">
                                                Špatně: {{ $fastest_attempt[0]->wrong_answers_number }}
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="my-5">
                            <div class="mb-3 text-center">
                                <b>Souhrný graf</b>
                            </div>
                            <div class="card chart-container">
                                <canvas id="chart"></canvas>
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
        const ctx = document.getElementById("chart").getContext('2d');
        var chartData =  {{ json_encode($chart_data) }};
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
