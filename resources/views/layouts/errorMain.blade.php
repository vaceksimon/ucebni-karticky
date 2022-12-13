<!-- *********************** -->
<!-- * Author: Tomas Bartu * -->
<!-- * Login: xbartu11     * -->
<!-- *********************** -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
<div class="position-relative">
    <img class="vh-100 vw-100 position-absolute" style="object-fit: cover" src="/img/flashcards.jpg" alt="random image">
</div>
@yield('errorPage')
</body>
</html>
