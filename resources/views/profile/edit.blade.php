@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div class="col-11">
                            {{ __('Úprava profilu') }}
                        </div>
                        @if($user['id'] == Auth::id() || Auth::user()->account_type == "admin")
                            <div class="col-10">
                                <button class="btn btn-outline-success"
                                        onclick="document.getElementById('submitBtn').click()">Uložit
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        @if(Request::get('errorValidation') !== null)
                            <div>
                                <p class="text-danger">Zadané údaje jsou špatné</p>
                            </div>
                        @endif
                        <form id="edit-form" method="POST" action="{{ route('profile.store') }}"
                              enctype="multipart/form-data">
                            <input id="user_id" name="user_id" value="{{$user['id']}}" hidden/>
                            @csrf
                            <div class="d-flex flex-nowrap flex-column">
                                <div class="row col-12 d-flex">
                                    <div class="col-6">
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <div>
                                                    <label for="first_name">Jméno * :</label>
                                                </div>
                                                <div>
                                                    <input id="first_name" name="first_name" type="text"
                                                           value="{{$user['first_name']}}" placeholder="Jméno">
                                                </div>
                                                <div>
                                                    <span id="errorFirstName" name="error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <label for="last_name">Příjmení * :</label>
                                            </div>
                                            <div>
                                                <input id="last_name" name="last_name" type="text"
                                                       value="{{$user['last_name']}}" placeholder="Příjmení">
                                            </div>
                                            <div>
                                                <span id="errorLastName" name="error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <label for="last_name">Email * :</label>
                                            </div>
                                            <div>
                                                <input id="email" name="email" type="text"
                                                       value="{{$user['email']}}" placeholder="email">
                                            </div>
                                            <div>
                                                <span id="errorEmail" name="error" class="text-danger"></span>
                                            </div>
                                        </div>
                                        <div class="mb-3 row row-center">
                                            <div>
                                                <label for="password">Heslo * :</label>
                                            </div>
                                            <div>
                                                <input id="password" name="password" type="password">
                                            </div>
                                            <div>
                                                <span id="errorPassword" name="error" class="text-danger"></span>
                                            </div>
                                            <script type="text/javascript">
                                                document.getElementById('password').addEventListener('keyup', checkValue('password', 'errorPassword', 8, 'Heslo'));
                                                document.getElementById('password').addEventListener('mouseup', checkValue('password', 'errorPassword', 8, 'Heslo'));
                                                document.getElementById('first_name').addEventListener('keyup', checkValue('first_name', 'errorFirstName', 1, 'Jméno'));
                                                document.getElementById('last_name').addEventListener('keyup', checkValue('last_name', 'errorLastName', 1, 'Příjmení'));
                                                document.getElementById('email').addEventListener('keyup', checkValue('email', 'errorEmail', 1, 'Email'));

                                                function checkValue(idInput, idSpan, length, prompt) {
                                                    return function () {
                                                        if (!checkLength(idInput, length)) {
                                                            document.getElementById(idSpan).textContent = prompt + " musí mít alespoň " + length + " znaků.";
                                                            document.getElementById(idInput).classList.add('bg-danger');
                                                        } else {
                                                            if (idInput === 'email' && !checkEmail(idInput)) {
                                                                document.getElementById(idSpan).textContent = "Emailová adresa je ve špatném tvaru";
                                                                document.getElementById(idInput).classList.add('bg-danger');
                                                            } else {
                                                                document.getElementById(idSpan).textContent = "";
                                                                document.getElementById(idInput).classList.remove('bg-danger');
                                                            }
                                                        }
                                                    }
                                                }

                                                function checkLength(id, length) {
                                                    var value = document.getElementById(id).value;
                                                    return (value.length >= length);
                                                }

                                                function checkEmail(id) {
                                                    let res = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                                                    return res.test(document.getElementById(id).value);
                                                }


                                                function validateFormAndSubmit() {
                                                    var errorElements = document.getElementsByName('error');
                                                    var isOk = true;
                                                    for (const element of errorElements) {
                                                        if (element.textContent !== "") {
                                                            isOk = false
                                                            break;
                                                        }
                                                    }
                                                    if (isOk)
                                                        document.getElementById('edit-form').submit();
                                                    else
                                                        alert('Vyplňte prosím povinné údaje.');
                                                }
                                            </script>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex gap-2 align-items-center">
                                            <div>
                                                <img src="{{asset($user->photo)}}" class="rounded-circle d-flex px-0"
                                                     style="width:150px; height: 150px"
                                                     alt="Avatar"/>
                                            </div>
                                            <div style="width: 60%">
                                                <div class="container my-auto">
                                                    <label class="input-group-text my-auto change-image"
                                                           style="width: 75px; cursor: pointer"
                                                           for="image">Nahrát</label>
                                                    <input type="file" onchange="this.form.submit()"
                                                           class="form-control" id="image" name="image"
                                                           style="cursor: pointer" hidden>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if($user['account_type'] == 'teacher')
                                    <div class="row mt-5">
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Titul před jménem:</label>
                                            </div>
                                            <div>
                                                <input id="degree_front" name="degree_front" type="text"
                                                       value="{{$user['degree_front']}}"
                                                       placeholder="Titul před jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Titul za jménem:</label>
                                            </div>
                                            <div>
                                                <input id="degree_after" name="degree_after" type="text"
                                                       value="{{$user['degree_after']}}" placeholder="Titul za jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Škola:</label>
                                            </div>
                                            <div>
                                                <input id="school" name="school" type="text"
                                                       value="{{$user['school']}}" placeholder="Škola">
                                            </div>
                                        </div>
                                        <div>
                                            {{--}}<input type="submit" id="submitBtn" name="submitBtn" class="btn btn-outline-success" value="Uložit" />{{--}}
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </form>
                        <button id="submitBtn" name="submitBtn" class="btn btn-outline-success"
                                onclick="validateFormAndSubmit()">Uložit
                        </button>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
