@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Zobrazení skupiny') }}
                    </div>

                    <div class="card-body">
                            <div class="row row-center">
                                <div class="col-7">
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
                                        <label for="name" class="col-form-label text-start">
                                            {{ __('Název') }} :
                                        </label>

                                        <div class="col-md-11">
                                            <label class="form-check-label text-black-50">
                                                <?php echo $group[0]->name ?>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="mb-3 row row-center">
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
                                    <div class="row row-center row-cols-2">
                                        <div class="row row-center" style="width: 40%">
                                            <img src="{{ $group[0]->photo }}" class="rounded-circle d-flex px-0" style="width: 160px; height: 160px;"
                                                 alt="Avatar"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 my-5">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row row-center row-cols-2">
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
                                                @empty($members)
                                                    <div class="text-center">
                                                        Vaše skupina zatím neobsahuje žádné členy.
                                                    </div>
                                                    <div class="row row-center mx-auto my-3" style="width: 120px">
                                                        <button type="button" class="btn btn-outline-primary btn-sm px-3" data-bs-toggle="modal" data-bs-target="#addMemberModal">Přidat člena</button>
                                                    </div>
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
                            </div>

                            <div class="my-3 row d-flex">
                                <a href="{{ route('mygroups') }}">
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
</script>