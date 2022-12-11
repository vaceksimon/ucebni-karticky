@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Zobrazení skupiny') }}
                    </div>

                    <div class="card-body">
                            <div class="row">
                                <div class="col-7">
                                    <div class="mb-3 row">
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

                                    <div class="mb-3 row">
                                        <label for="name" class="col-form-label text-start">
                                            {{ __('Název') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <label class="form-check-label text-black-50">
                                                <?php echo $group[0]->name ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="description" class="col-form-label text-start">
                                            {{ __('Popis') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <label class="form-check-label text-black-50">
                                                <?php echo $group[0]->description ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <!-- Second column -->
                                    <div class="row">
                                        <div class="row col-lg-5">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex px-0" style="aspect-ratio : 1 / 1; width: 100%; object-fit: cover;" alt="Avatar"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 my-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row row-cols-2">
                                            <div>
                                                {{ __('Členové') }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div style="height: 300px;overflow-y: scroll;">
                                            <table class="table table-striped">
                                                <thead>
                                                </thead>
                                                @empty($members[0])
                                                    <tbody>
                                                        <tr>
                                                            <div class="my-5">
                                                                <div class="text-center">
                                                                    Skupina zatím neobsahuje žádné členy.
                                                                    <i class="bi bi-emoji-frown"></i>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    </tbody>
                                                @else
                                                    <tbody>
                                                    @foreach($members as $member)
                                                        <tr>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                <img src="{{ $member->photo }}" class="rounded-circle d-flex px-0" style="width: 40px; height: 40px;"
                                                                     alt="Avatar"/>
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->degree_front }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->first_name }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->last_name }}
                                                            </td>
                                                            <td class="clickable-row" data-href="{{ route('profile', [$member->user_id]) }}">
                                                                {{ $member->degree_after }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                @endempty
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @if($group[0]->type == 'students')
                                    <div class="card mt-5">
                                        <div class="card-header">
                                            {{__('Zadaná cvičení')}}
                                        </div>
                                        <div id="assignedExercisesBody" name="assignedExercisesBody" class="card-body" style="max-height: 10000px; overflow-y: scroll;">
                                            @foreach($exercises as $exercise)
                                            <div class="card mt-2">
                                                <div class="card-header d-flex align-items-center">
                                                    <div>
                                                        {{$exercise->name}}
                                                    </div>
                                                    @if(Auth::id() == $group[0]->owner)
                                                        <div class="ms-auto">
                                                            <button type="submit" class="btn btn-outline-danger" onclick="unassignExercise({{$exercise->id}}, {{$group[0]->id}})">Zrušit zadání</button>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="card-body">
                                                    <p class="mb-0">Počet kartiček: {{$exercise->pocet}}</p>
                                                    <p class="mb-0">Téma: {{$exercise->topic}}</p>
                                                    <hr class="my-2">
                                                    <div class="mb-2">Popis:</div>
                                                    <p class="card-text">{{$exercise->description}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="my-3 row d-flex">
                                <a href="{{ url()->previous() }}">
                                    <input type="button" class="btn btn-outline-secondary btn-lg px-4" value="Zpět">
                                </a>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });

    function unassignExercise(exerciseID, groupId) {
        $.post('{{route('mygroups.unassign-exercise')}}', {
            _token: $('meta[name="csrf-token"]').attr('content'),
            group_id: groupId,
            exercise_id: exerciseID
        });
        loadAssignedExercises(groupId);
    }

    function loadAssignedExercises(groupId) {
        if('{{$group[0]->type}}' === 'students') {
            $.post('{{route('mygroups.get-assignments')}}', {
                _token: $('meta[name="csrf-token"]').attr('content'),
                group_id: groupId
            }, function (data) {
                postAssignments(data);
            });
        }
    }

    function postAssignments(data) {
        let htmlView = ``;
        for(let i = 0; i < data.length; i++) {
            htmlView += `
                <div class="card mt-2">
                    <div class="card-header d-flex align-items-center">
                        <div>` + data[i].name + `</div>
                        <div class="ms-auto">
                            <button type="submit" class="btn btn-outline-danger" onclick="unassignExercise(` + data[i].id + `, ` + data[i].id + `)">
                                Zrušit zadání
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">Počet kartiček: ` + data[i].pocet + `</p>
                        <p class="mb-0">Téma: ` + data[i].topic + `</p>
                        <hr class="my-2">
                        <div class="mb-2">Popis:</div>
                        <p class="card-text">` + data[i].description + `</p>
                    </div>
                </div>
            `
        }
        $('#assignedExercisesBody').html(htmlView);
    }

</script>
