<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{$title}}</title>
    <meta name="description" content="Использование интернет-голосований — это простой способ получать от аудитории мгновенные отзывы, касающиеся чего угодно.">

    <meta property="og:title" content="{{$title}}">
    <meta property="og:type" content="article" />
    <meta property="og:description" content="Использование интернет-голосований — это простой способ получать от аудитории мгновенные отзывы, касающиеся чего угодно.">
    <meta property="og:image" content="{{ asset('img/logo-share.png') }}">
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
{{--    @vite('resources/css/app.css')--}}
</head>
<body>
<div id="app">
</div>
@vite('resources/js/app.js')
</body>
</html>
