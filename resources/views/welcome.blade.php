<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Онлайн опросы</title>
        <meta name="description" content="Использование интернет-голосований — это простой способ получать от аудитории мгновенные отзывы, касающиеся чего угодно.">
        <meta name="keywords" content="бесплатный опрос, бесплатные опросы, бесплатный конструктор опросов, бесплатный создатель опросов, бесплатный сайт опроса, создание бесплатного опроса, проведение бесплатного опроса, бесплатный опрос, бесплатные опросы, бесплатный опросник, бесплатные анкеты, опросы общественного мнения">
        <meta property="og:image" content="{{ asset('img/logo-share.png') }}">
        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
       <div id="app">
       </div>
       @vite('resources/js/app.js')
    </body>
</html>
