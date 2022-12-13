<!-- *********************** -->
<!-- * Author: Tomas Bartu * -->
<!-- * Login: xbartu11     * -->
<!-- *********************** -->
@guest()
    @extends('layouts/app', ['activePage' => 'public-flashcardPractise', 'title' => 'Učební Kartičky'])
@endguest
@auth()
    @extends('layouts.main')
@endauth

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
                                <p class="fs-4">Tyto výsledky nebudou započítány do systému</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="text-center fs-5">
                            <div id="timer"><label id="hours"></label>:<label id="minutes"></label>:<label id="seconds"></label></div>
                            <div class="text-center">
                                <a href="{{ route('public-exercises') }}">
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
        let showFront = true;

        function getCards() {
            let cid = document.getElementById('cards').getAttribute('data-id');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                data: {"id": cid},
                url: "{{ route('public-flashcard.get-cards') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    cardSet = data;
                    shuffle(cardSet);
                    showCard();
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        function changeQA() {
            if (showFront) {
                document.getElementById('flip').innerText = " Odpověď";
                document.getElementById('QA').innerText      = "Otázka";
            } else {
                document.getElementById('flip').innerText = " Otázka";
                document.getElementById('QA').innerText = "Odpověď";
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
            clearInterval(interval);
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
        getCards();

        let sec = 0;

        function pad ( val ) {
            return val > 9 ? val : "0" + val;
        }

        function getTimer() {
            return pad(parseInt(sec / 3600, 10)) + ':' + pad(parseInt(sec / 60, 10)) + ':' + pad( sec % 60 );
        }

        interval = setInterval( function() {
            document.getElementById("seconds").innerHTML = pad(++sec % 60);
            document.getElementById("minutes").innerHTML = pad(parseInt(sec / 60,10));
            document.getElementById("hours").innerHTML   = pad(parseInt(sec / 3600, 10))
        }, 1000);

    </script>
@endsection
