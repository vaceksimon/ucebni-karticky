# AJAX

Funkce bude předvedena na názorném příkladu. \

Nejlépe psát přímo do _\*.blade.php_ na konec souboru, ale ne za konec sekce značené: _@endsection_. Samotný skript bude
začínat následovně:
```javascript
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script type="text/javascript">
...
Samotný kod
...
</script>
```

Jak vlastně nastavit AJAX?
1. Nejdříve je potřeba nastavit hlavičku
```javascript
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
```
2. Potom je potřeba nastavit vlastní tělo
```javascript
$.ajax({
    data: {"id": exercise_id, "count": pocet, "data"... }, // zde lze uložit pojmenované atributy dotazu
    url: "{{ route('flashcard.get-cards') }}",         // kam se bude posilat, na jakou cestu
    type: "POST",     // metoda odesilani
    dataType: 'json', // jaka data ocekavame od serveru
    success: function (data) {
        // v proměnné data se nachází odpověď od serveru
        },
    error: function (data) {
        console.log('Error:', data);
    }
});
```
Krok 1 a 2 může ve funkci vypadat následovně:
```javascript
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
```
3. Zde pro metodu POST se v souboru _web.php_ nastaví cesta následovně:
```php
Route::post('flashcard', [\App\Http\Controllers\Flashcards\FlashcardController::class, 'getCards'])->name('flashcard.get-cards');
```
Tim se zavolá funkce _getCards_
4. Teď je potřeba zpracovat dotaz a jeho parametry
```php
public function getCards(Request $request)
    {
        echo $request->count;
        $cards = DB::table('flashcards')
            ->select('*')
            ->where('exercise_id', '=', $request->id)
            ->get();
        return $cards;
    }
```

