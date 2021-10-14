<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Super Ges- @yield('page_title')</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    </head>
    <body>
    @include('layouts._partials.header')
    @yield('content')
    </body>
</html>