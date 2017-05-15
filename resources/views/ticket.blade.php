@extends('baseTicket')
@section('title')
    Ticket
@endsection  
@section('contenido')
    
    <span style="text-align: center;font-size:1.3em;">AGENCIA DE LOTERIAS XXXX</span>
    <br>
    <span>-----------------------------------------------------------------------------------------------------</span>
    <br>
    
    <div  style="text-align: left;">
          
          <br>
          <div style="text-align: left;">
              <span style="font-size:0.9em;">{{"Nro: ".$numero}}</span>
              <br>
              <span style="font-size:0.9em;">{{"Fecha: ".$fecha}}</span>
              <br>
              <span style="font-size:0.9em;">{{"Hora: ".$hora}}</span>
          </div>
         <br>
        <span>-----------------------------------------------------------------------------------------------------</span>
         <br>
         <div>
           
               <table style="width:100%;height:20%;">
                    <tr>
                        <td style="text-align: left;width:33%;height:100%;">Loterias</td>
                        <td style="text-align: center;width:33%;height:100%;">Jugadas</td>
                        <td style="text-align: left;width:33%;height:100%;">Apuestas</td>
                    <tr>


               </table>
         </div>


          @foreach($ventas as $jugada)
              <br>
              <br>
              <span style="text-align: left;font-size:0.9em;">{{$jugada[0]}}</span>
              <br>
              <span>-----------------------------------------------------------------------------------------------------</span>
              <div style="text-align: left; ">
                    
                     <br>
                     
                        <table style="width:100%;height:20%;">
                                
                             
                                @foreach($jugada[1] as $lista)
                                   <tr style=" width:50%;height:50%;">
                                       <td style="text-align: right; width:54%;height:100%;font-size:0.9em;">{{$lista[0]}}</td>
                                       <td style="text-align: center; width:46%;height:100%;font-size:0.9em;">{{$lista[1]." €"}}</td>
                                  </tr>
                                @endforeach
                                


                        </table>
                    

                    
              </div>
          @endforeach
          
          <br>
          <br>
         <span>-----------------------------------------------------------------------------------------------------</span>
          <div  >
              
               
               <br>
               <span >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{  "Total: ".$total."  €" }}</span>
                             
                                
          </div>
          <br>
          <br>
          <div  style="text-align:center;font-size:1.2em;">
              
               <span>Buena suerte !!!</span>
                             
                                
          </div>
      
    </div>
 
@endsection