@extends('layouts.main')

@section('content')
    <div>
        <h1>Flash Card Web App</h1>
        <div class="container">

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
@endsection
