@extends('layouts.main')

@section('content')
    <div>
        <h1>Flash Card Web App</h1>
        <div class="container" id="cards" data-id="{{$id}}">

            <div id="card-area" class="card-area">
                <h2>Cards</h2>

                <div class="card" id="card" onclick={flipCard()}>
                    <div class="card-body"></div>
                </div>

                <div>Click on the card to flip sides</div>

                <p class="add-new-card" onclick={addNewCard()}>add new card</p>

                <button type="button" class="btn btn-secondary" onclick={getNextCard()}>Next Card</button>

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

        function flipCard(){
            showFront = !showFront;
            showCard();
        }

        function showCard(){
            let text = showFront ? cardSet[currentCard].question : cardSet[currentCard].answer;
            card.innerText = text;
        }

        function getNextCard(){
            currentCard < cardSet.length - 1 ? currentCard++ : currentCard = 0;
            showFront = true;
            showCard();
        }

        getCards();
    </script>
@endsection
