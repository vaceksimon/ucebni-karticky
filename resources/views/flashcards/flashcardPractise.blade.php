@extends('layouts.main')
<!-- *********************** -->
<!-- * Author: Tomas Bartu * -->
<!-- * Login: xbartu11     * -->
<!-- *********************** -->
@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="d-flex justify-content-evenly">
                    <h1 id="correct" class="text-center text-success col-4" ></h1>
                    <h1 id="counter" class="text-center col-4" ></h1>
                    <h1 id="wrong"   class="text-center text-danger col-4" ></h1>
                </div>
                <div class="card">
                    <div class="card-header px-0">
                        <div class="d-flex justify-content-center align-content-center">
                            <div class="text-center col-4">
                                <button id="btnCorrect" type="button" class="btn btn-success btn-lg fs-4" onclick={getCorrect()}>Správně <i class="bi bi-check-lg"></i></button>
                            </div>
                            <div class="text-center col-4">
                                <button type="button" id="btnFlip" class="btn btn-primary btn-lg fs-4" onclick={flipCard()} style="width: 200px"><span id="flip"></span> <i class="bi bi-arrow-repeat"></i></button>
                            </div>
                            <div class="text-center col-4">
                                <button id="btnWrong" type="button" class="btn btn-danger btn-lg fs-4" onclick={getWrong()}>Špatně <i class="bi bi-x-lg"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container flashcard" id="cards" data-id="{{$id}}">
                            <h2 id="QA" class="text-decoration-underline m-auto text-center">Otázka</h2>
                            <div id="card-area" class="mb-4">
                                <div id="frontCard" class="fs-2 text-center" onclick={flipCard()}></div>
                            </div>
                            <div id="result" class="text-center" style="display: none">
                                <h2>Výsledky cvičení</h2>
                                <p class="fs-4 text-success">Správných odpovědí: <span id="resultCorrect"></span></p>
                                <p class="fs-4 text-danger" >Špatných odpovědí:  <span id="resultWrong"  ></span></p>
                                <p class="fs-4 text-warning">Uběhnutý čas: <span id="resultTimer"  ></span></p>
                                @if($role === 'teacher')
                                    <p class="fs-4">Tyto výsledky nebudou započítány do systému</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center fs-5">
                            <div id="timer" data-timer="1"><label id="hours"></label>:<label id="minutes"></label>:<label id="seconds"></label></div>
                            <div class="text-center">
                                <a href="{{ route('myexercises') }}">
                                    <button id="btnBack" type="button" class="btn btn-info btn-lg m-auto" style="display: none">Zpět na seznam cvičení</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript">
        let cardSet;

        let currentCard = 0;
        let correctCounter = 0;
        let wrongCounter = 0;
        let sec = 0;
        let showFront = true;
        let cid = document.getElementById('cards').getAttribute('data-id');

        function getCards() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"id": cid},
                url: "{{ route('flashcard.get-cards') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    cardSet = data;
                    showCard();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function storeSession()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"correct": correctCounter - 1,
                       "counter": currentCard - 1,
                       "wrong": wrongCounter - 1,
                       "sec": sec,
                       "id": cid
                },
                url: "{{ route('flashcard.store-session') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {},
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function getSession()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"id": cid},
                url: "{{ route('flashcard.get-session') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    let res = JSON.parse(data.result);
                    currentCard = parseInt(res[0].counter, 10) + 1;

                    // shuffle
                    let arr1 = cardSet.splice(0, currentCard);
                    console.log(cardSet);
                    let arr2 = shuffle(cardSet);
                    cardSet = arr1.concat(arr2);

                    correct.innerText = parseInt(res[0].correct, 10);
                    correctCounter = parseInt(res[0].correct, 10) + 1;
                    wrong.innerText = parseInt(res[0].wrong, 10);
                    wrongCounter = parseInt(res[0].wrong) + 1;
                    sec = res[0].sec;
                    counter.innerText = (currentCard + 1).toString() + "/" + cardSet.length.toString();
                    showCard();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function isTimerVisible()
        {
            let r = 0;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"id": cid},
                url: "{{ route('flashcard.is-timer-visible') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    let res = JSON.parse(data);
                    document.getElementById('timer').setAttribute('data-timer', res[0].show_timer);
                    setTimer();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
            return r;
        }

        function changeQA() {
            if (showFront) {
                document.getElementById('flip').innerText = " Odpověď";
                document.getElementById('QA').innerText      = "Otázka:";
            } else {
                document.getElementById('flip').innerText = " Otázka";
                document.getElementById('QA').innerText      = "Odpověď:";
            }
        }

        function flipCard() {
            changeQA();
            showFront = !showFront;
            showCard();
        }

        function showCard() {
            let text = showFront ? cardSet[currentCard].question : cardSet[currentCard].answer;
            counter.innerText = (currentCard + 1).toString() + "/" + cardSet.length.toString();
            changeQA();
            frontCard.innerText = text;
        }

        function getNextCard() {
            if (currentCard < cardSet.length - 1) {
                currentCard++;
                showFront = true;
                showCard();
            } else {
                showResults();
            }
        }

        function getPrevCard() {
            currentCard !== 0 ? currentCard-- : currentCard = cardSet.length - 1;
            showFront = true;
            showCard();
        }

        function getCorrect() {
            correct.innerText = correctCounter++;
            getNextCard();
        }

        function getWrong() {
            wrong.innerText = wrongCounter++;
            getNextCard();
        }

        function showResults() {
            document.getElementById('card-area').style.display = 'none';
            document.getElementById('result').style.display    = 'block';
            document.getElementById('timer').style.display     = 'none';
            document.getElementById('btnBack').style.display   = 'block';
            document.getElementById('btnCorrect').disabled     = true;
            document.getElementById('btnWrong').disabled       = true;
            document.getElementById('btnFlip').disabled        = true;
            document.getElementById('resultCorrect').innerHTML = (correctCounter - 1).toString();
            document.getElementById('resultWrong').innerText   = (wrongCounter - 1).toString();
            document.getElementById('resultTimer').innerText   = getTimer();

            @if($role == 'student')
                sendResult();
            @endif

            clearResult();
            clearInterval(interval);
        }

        function clearResult() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {},
                url: "{{ route('attempt.clear-attempt') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data !== "1")
                    {
                        alert("Výsledky se neporařilo uložit.");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function sendResult() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"correctCount" : correctCounter - 1,
                       "wrongCount"   : wrongCounter   - 1,
                       "timer"        : getTimer(),
                       "exercise_id"  : document.getElementById('cards').getAttribute('data-id')
                },
                url: "{{ route('attempt.save-attempt') }}",
                type: "POST",
                dataType: 'text',
                success: function (data) {
                    if (data !== "1")
                    {
                        alert("Výsledky se neporařilo uložit.");
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        // The Fisher-Yates algorithm
        function shuffle(array) {
            var j, tmp, i;
            for (i = array.length - 1; i > 0; i--) {
                j = Math.floor(Math.random() * (i + 1));
                tmp = array[i];
                array[i] = array[j];
                array[j] = tmp;
            }
            return array;
        }

        correct.innerText = correctCounter++;
        wrong.innerText = wrongCounter++;
        isTimerVisible();
        getCards();
        getSession();

        function pad ( val ) {
            return val > 9 ? val : "0" + val;
        }

        function getTimer() {
            return pad(parseInt(sec / 3600, 10)) + ':' + pad(parseInt(sec / 60, 10)) + ':' + pad( sec % 60 );
        }

        function setTimer() {
            let isVisible = document.getElementById('timer').getAttribute('data-timer');
            interval = setInterval(function () {
                storeSession();
                if (isVisible === '1') {
                    document.getElementById("seconds").innerHTML = pad(++sec % 60);
                    document.getElementById("minutes").innerHTML = pad(parseInt(sec / 60, 10));
                    document.getElementById("hours").innerHTML = pad(parseInt(sec / 3600, 10));
                } else {
                    sec++;
                    document.getElementById('timer').innerHTML = '<i>Časovač je skrytý</i>'
                }
            }, 1000);
        }
    </script>
@endsection
