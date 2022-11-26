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
                            <b>Základní informace:</b>

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

                        @empty($most_successful_attempt[0])
                            <div class="text-center my-5">
                                <h4>
                                    Dané cvičení zatím nebylo dokončeno.
                                    <i class="bi bi-emoji-frown"></i>
                                </h4>
                            </div>
                        @else
                        <div class="my-5">
                            <b>Nejrúspěšnější pokus</b>
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

                        <div class="my-5">
                            <b>Nejrychlejší pokus</b>
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

                        @endempty
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
