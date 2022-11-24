@extends('layouts.main')

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h1 id="counter" class="text-center col-4 m-auto" ></h1>
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-evenly">
                            <div>
                                <button type="button" class="btn btn-secondary" onclick={getPrevCard()}>Předchozí kartička</button>
                            </div>
                            <div>
                                <button type="button" id="btnFlip" class="btn btn-primary" onclick={flipCard()} style="width: 160px">Zobraz odpověď</button>
                            </div>
                            <div>
                                <button type="button" class="btn btn-secondary" onclick={getNextCard()}>Následující kartička</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container flashcard" id="cards" data-id="{{$id}}">
                            <h2 id="QA" class="text-decoration-underline m-auto text-center">Otázka</h2>
                            <div id="card-area" class="mb-4">
                                <div id="frontCard" class="fs-2 text-center" onclick={flipCard()}></div>
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

        function flipCard() {
            if (!showFront) {
                document.getElementById('btnFlip').innerText = "Zobraz odpověď";
                document.getElementById('QA').innerText      = "Otázka";
            } else {
                document.getElementById('btnFlip').innerText = "Zobraz otázku";
                document.getElementById('QA').innerText = "Odpověď";
            }
            showFront = !showFront;
            showCard();
        }

        function showCard() {
            let text = showFront ? cardSet[currentCard].question : cardSet[currentCard].answer;
            counter.innerText = (currentCard + 1).toString() + "/" + cardSet.length.toString();
            frontCard.innerText = text;
        }

        function getNextCard() {
            currentCard < cardSet.length - 1 ? currentCard++ : currentCard = 0;
            showFront = true;
            showCard();
        }

        function getPrevCard() {
            currentCard !== 0 ? currentCard-- : currentCard = cardSet.length - 1;
            showFront = true;
            showCard();
        }

        getCards();

    </script>
@endsection
