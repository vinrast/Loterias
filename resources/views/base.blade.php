<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') | Loteria Dominicana </title>
    <link rel="stylesheet" href="{{asset('css/materialize.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/stylelog.css')}}">
</head>
<body>
    @yield('contenido')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/materialize.min.js')}}"></script>
</body>
</html>