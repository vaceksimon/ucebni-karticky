let cardSet;

let currentCard = 0;
let showFront = true;

let card  = document.querySelector("#card");

async function getCards(){
    let response = await fetch('/flashcard', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'url': '/flashcard',
            "X-CSRF-Token": document.querySelector('input[name=_token]').value
        },
    });
    cardSet = await response.json();
    console.log (cardSet);
    showCard();
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
