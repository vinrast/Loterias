<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> @yield('title') | Loteria Dominicana </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/css/materialize.min.css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Ropa+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Narrow" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('plugins/sweetalert/sweetalert.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
</head>
<body onload="inicio()">
    @yield('contenido')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.1/js/materialize.min.js"></script>
    <script src="{{asset('js/reloj.js')}}"></script>
    <script src="{{asset('js/setmodales.js')}}"></script>
    <script src="{{asset('js/frontEnd.js')}}"></script>
    <script src="{{asset('js/apuesta.js')}}"></script>
    <script src="{{asset('js/jugadaDia.js')}}"></script>
    <script src="{{asset('js/listar_ticket.js')}}"></script>
  
    <script src="{{asset('plugins/sweetalert/sweetalert.min.js')}}"></script>
</body>
</html>