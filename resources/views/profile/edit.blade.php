@extends('layouts.main')

@section('content')
    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div>
                            {{ __('Úprava profilu') }}
                        </div>
                        <div class="ms-auto">
                            <a href="javascript:window.history.back()"
                               style="text-decoration: none">
                                <button class="btn btn-outline-secondary me-2">
                                    Zrušit
                                </button>
                            </a>
                            <button class="btn btn-outline-success"
                                    onclick="document.getElementById('submitBtn').click()">
                                Uložit
                            </button>
                        </div>
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
                                <div class="row">
                                    <div class="col-7">
                                        <div class="mb-3 row">
                                            <div class="pe-5">
                                                <div>
                                                    <label for="first_name">Jméno * :</label>
                                                </div>
                                                <div>
                                                    <input class="form-control" id="first_name" name="first_name" type="text"
                                                           value="{{$user['first_name']}}" placeholder="Jméno">
                                                </div>
                                                <div>
                                                    <span id="errorFirstName" name="error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="pe-5">
                                                <div>
                                                    <label for="last_name">Příjmení * :</label>
                                                </div>
                                                <div>
                                                    <input class="form-control" id="last_name" name="last_name" type="text"
                                                           value="{{$user['last_name']}}" placeholder="Příjmení">
                                                </div>
                                                <div>
                                                    <span id="errorLastName" name="error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="pe-5">
                                                <div>
                                                    <label for="last_name">Email * :</label>
                                                </div>
                                                <div>
                                                    <input class="form-control" id="email" name="email" type="text"
                                                           value="{{$user['email']}}" placeholder="email">
                                                </div>
                                                <div>
                                                    <span id="errorEmail" name="error" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <div class="pe-5">
                                                <div>
                                                    <label for="password">Heslo * :</label>
                                                </div>
                                                <div>
                                                    <input class="form-control" id="password" name="password" type="password">
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
                                    </div>
                                    <div class="col-5">
                                        <div class="row">
                                            <div class="row col-lg-5">
                                                <img id="img_profile" name="img_profile" src="{{asset($user->photo)}}" class="rounded-circle d-flex my-lg-auto mx-lg-0 my-3 mx-auto px-0" style="aspect-ratio : 1 / 1; width: 100%; object-fit: cover;" alt="Avatar"/>
                                            </div>
                                            <div class="row col-lg-7">
                                                <div class="container my-auto">
                                                    <label class="input-group-text my-lg-auto mx-lg-0 my-3 mx-auto change-image"
                                                           style="width: 75px; cursor: pointer"
                                                           for="image">Nahrát</label>
                                                    <input type="file"
                                                           class="form-control" id="image" name="image"
                                                           onchange="photoSelected(this)"
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
                                            <div class="col-md-4">
                                                <input class="form-control" id="degree_front" name="degree_front" type="text"
                                                       value="{{$user['degree_front']}}"
                                                       placeholder="Titul před jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Titul za jménem:</label>
                                            </div>
                                            <div class="col-md-4">
                                                <input class="form-control" id="degree_after" name="degree_after" type="text"
                                                       value="{{$user['degree_after']}}" placeholder="Titul za jménem">
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div>
                                                <label for="degree_front">Škola:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <input class="form-control" id="school" name="school" type="text"
                                                       value="{{$user['school']}}" placeholder="Škola">
                                            </div>
                                        </div>
                                        <div>
                                        </div>
                                    </div>
                                @endif

                            </div>
                        </form>
                        <div class="mt-5">
                            <button id="submitBtn" name="submitBtn" class="btn btn-outline-success"
                                    onclick="validateFormAndSubmit()">Uložit
                            </button>
                            <a href="javascript:window.history.back()"
                               style="text-decoration: none">
                                <button class="btn btn-outline-secondary ms-2">
                                    Zrušit
                                </button>
                            </a>
                        </div>
                        @if($user['account_type'] != 'admin')
                            <div class="mt-5">
                                <p class="text-danger fw-bold mb-1">Nebezpečná zóna:</p>
                                <button class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#removeUserPrompt">Smazat profil
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div id="removeUserPrompt" class="modal fade" tabindex="-1" aria-labelledby="addMemberModalLabel"
                 aria-hidden="true" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Upozornění</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>Opravdu si přejete smazat
                                @if(Auth::user()->account_type != 'admin')
                                    svůj profil?
                                @else
                                    uživatele?
                                @endif
                            </p>
                        </div>
                        <div class="modal-footer">
                            <form method="post" action="
                            @if(Auth::user()->account_type != 'admin')
                                {{ route('profile.delete') }}
                            @else
                                {{ route('user-administration.remove-user') }}
                            @endif
                            ">
                                @csrf
                                <input type="hidden" id="user_id" name="user_id" value="{{$user['id']}}">
                                <button type="submit" class="btn btn-primary">Ano</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Ne</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <script>
        function photoSelected(profilePhoto) {
            let url = profilePhoto.value;
            let ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
            if (profilePhoto.files && profilePhoto.files[0] && (ext === "gif" || ext === "png" || ext === "jpeg" || ext === "jpg")) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img_profile').attr('src', e.target.result);
                }
                reader.readAsDataURL(profilePhoto.files[0]);
            }
        }
    </script>

@endsection
