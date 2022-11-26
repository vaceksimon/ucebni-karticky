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

                        <div class="my-5">
                            <b>Nejrúspěšnější pokus</b>
                            <ul>
                                <li>
                                    Datum:
                                </li>
                                <li>
                                    Čas:
                                </li>
                                <li>
                                    Úspěšnost:
                                    <ul>
                                        <li>
                                            Počet otázek:
                                        </li>
                                        <li style="color: green">
                                            Správně:
                                        </li>
                                        <li style="color: red">
                                            Špatně:
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div class="my-5">
                            <b>Nejrychlejší pokus</b>
                            <ul>
                                <li>
                                    Datum:
                                </li>
                                <li>
                                    Čas:
                                </li>
                                <li>
                                    Úspěšnost:
                                    <ul>
                                        <li>
                                            Počet otázek:
                                        </li>
                                        <li style="color: green">
                                            Správně:
                                        </li>
                                        <li style="color: red">
                                            Špatně:
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
