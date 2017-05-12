@extends('baseTicket')
@section('title')
    Ticket
@endsection  
@section('contenido')
    
    <span style="text-align: center;font-size:1.2em;">Agencia de loterias XXXX</span>
    <div  style="text-align: left;border-top: black 1px solid;">
          
          <br>
          <div style="text-align: left;">
              <span style="font-size:0.9em;">{{"Nro: ".$numero}}</span>
              <br>
              <span style="font-size:0.9em;">{{"Fecha: ".$fecha}}</span>
          </div>
          @foreach($ventas as $jugada)
              <br>
              <span style="text-align: left;font-size:0.9em;">{{$jugada[0]}}</span>
              <div style="text-align: left;border-top: black 1px solid; ">
                    
                     <br>
                     
                        <table style="width:100%;height:20%;">
                                
                                <tr style=" width:50%;height:50%;">
                                @foreach($jugada[1] as $lista)
                                    <td style="text-align: center; width:50%;height:50%;font-size:0.9em;">{{$lista." €"}}</td>
                                @endforeach
                                </tr>


                        </table>
                    

                    
              </div>
          @endforeach
          
          <br>
          <br>
         
          <div  style="text-align:right;font-size:1.2em;">
              
               <span >{{  "total: ".$total."  €" }}</span>
                             
                                
          </div>
          <br>
          <br>
          <div  style="text-align:center;font-size:1.2em;">
              
               <span>Buena suerte !!!</span>
                             
                                
          </div>
      
    </div>
 
@endsection