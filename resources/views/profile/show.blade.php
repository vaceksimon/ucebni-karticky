@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <a href="{{url()->previous()}}">
                    <button class="btn btn-outline-secondary mb-2">Zpět</button>
                </a>
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            {{ __('Zobrazení profilu') }}
                        </div>
                        @if($user['id'] == Auth::id())
                            <div class="ms-auto">
                                <a href="{{route('profile.edit')}}">
                                    <button class="btn btn-outline-primary">Upravit</button>
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="card-body">
                        <div class="mb-3 row row-cols-2">
                            <div class="mb-3 row">
                                <div>
                                    Jméno:
                                    {{$user['first_name']}}
                                </div>
                                <div>
                                    Příjmení:
                                    {{$user['last_name']}}
                                </div>
                                @if($user['id'] == Auth::id())
                                    <div>
                                        Email:
                                        {{$user['email']}}
                                    </div>
                                @endif
                            </div>
                            <div class="row">
                                <img src="{{asset($user['photo'])}}" class="rounded-circle d-flex px-0"
                                     style="width:150px; height: 150px"
                                     alt="Avatar"/>
                            </div>
                        </div>
                        @if($user['account_type'] == 'teacher')
                            <div class="mb-3 row">
                                @if(isset($user['degree_front']))
                                    <div>
                                        Titul před:
                                        {{$user['degree_front']}}
                                    </div>
                                @endif
                                @if(isset($user['degree_after']))
                                    <div>
                                        Titul za:
                                        {{$user['degree_after']}}
                                    </div>
                                @endif
                                @if(isset($user['school']))
                                    <div>
                                        Škola:
                                        {{$user['school']}}
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @if($user['id'] != Auth::id())
                    <div class="card mt-3">
                        <div class="card-header">
                            Společné skupiny
                        </div>
                        <div id="groups_body" name="groups_body" class="card-body">

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <script>
        @if(isset($user['id']) && Auth::id() != $user['id'])
        getCommonGroups();
        @endif

        function getCommonGroups() {
            $.post('{{ route("profile.commonGroups") }}',
                {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    user_id: {{$user['id']}}
                },
                function (data) {
                    console.log(data);
                    postCommonGroups(data);
                });
        }

        function postCommonGroups(data) {
            htmlView = '';
            for (let i = 0; i < data.result.length; i++) {
                if (i % 3 === 0) {
                    htmlView += `
                        <div class="row mb-3">`
                }

                htmlView += `
                    <div class="col">
                        <div class="card" style="width: 18rem;">
                            <img src="` + data.result[i].photo + `" class="card-img-top" alt="Foto skupiny">
                            <div class="card-body">
                                <h5 class="card-title">` + data.result[i].name + `</h5>
                                <p class="card-text">` + data.result[i].description + `</p>
                                <form method="POST" action="`
                htmlView += `{{route('mygroups.clickShow')}}`;
                htmlView += `">`;
                htmlView += `@csrf`;
                htmlView += `
                                    <input type="hidden" id="group_id" name="group_id" value="` + data.result[i].id + `" />
                                    <button type="submit" class="btn btn-primary">Zobrazit skupinu</button>
                                </form>
                            </div>
                        </div>
                    </div>
                `;

                if ((i + 1) % 3 === 0 || i === (data.result.length + 1))
                    htmlView += `</div>`
            }
            $('#groups_body').html(htmlView);
        }

    </script>
@endsection
