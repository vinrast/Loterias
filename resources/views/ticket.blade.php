@extends('baseTicket')
@section('title')
    Ticket
@endsection  
@section('contenido')
    
    <div  style="text-align: center;">
          <span style="text-decoration:underline;">Nombre del negocio</span>
          <br>
          <br>
          <div style="text-align: left;">
              <span>{{"Nro: ".$numero}}</span>
              <br>
              <span>{{"Fecha: ".$fecha}}</span>
          </div>
      
    </div>
 
@endsection