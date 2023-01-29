<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title> Carnet Candidato</title>
    </head>

    <style>

        body{
          font-family: Verdana, arial, sans-serif;
          font-size: 8px;
        }

        @page { margin: 30px 40px; }

        .page-break {
          page-break-after: always;
        }


        .titulo{
          background-color: #333131;
          padding: 10px 0px;
          color: #FFFFFF;
          text-align: center;
          font-size: 16px;
        }

        .tabla1 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            width: 180px;
            font-size: 14px;
        }

        .tabla2 tr th{
            background-color: #fdf099;
            font-weight: bold;
            padding: 5px 10px;
            text-align: left;
            font-size: 8px;
        }

        .tabla1 tr td{
          padding: 5px 10px;
          font-size: 8px;
          width: 100%;
        }

        .tabla2 tr td{
          padding: 5px 10px;
          font-size: 8px;
        }

        .col-center{
          float: none;
          margin-left: auto;
          margin-right: auto;
        }

        .logo_derecha{      
          position: absolute;
          right: 0;
        }

    </style>

    <body>        

     <?php $fondo = "background-image: url('".url('carnet_candidatos.jpg')."');"; ?>

     <div style="position: relative; margin:0;">
       <img alt="Logo T3RS" class="" src="{{public_path().'/carnet_candidatos.jpg'}}" style="position: absolute;width:100%;height:280px;">
        
       <div style="postion:absolute;width:56%;z-index:1;">
        <div class="datos_candidato" style="float:left;word-wrap: break-word;top:35px;height:auto; width:28%; position: relative;z-index:2; margin-left:16px;">

         <span> 
            @if($candidato->foto_perfil != "" && file_exists("recursos_datosbasicos/$candidato->foto_perfil") )
             <img style="width:100%;height:183px;" alt="user photo" src="{{ public_path().'/recursos_datosbasicos/'.$candidato->foto_perfil}}" />
            @elseif($candidato->avatar != null && $candidato->avatar != "")
             <img style="width:100%;height:183px;" alt="user photo" src="{{ $candidato->avatar }}" />
            @else
             <img style="width:100%;height:183px;" alt="user photo" src="{{ public_path().'/img/personaDefectoG.jpg'}}"/>
            @endif
         </span>
         <br><br><br>
         <span style="padding-left:10px;font-size:10px;width:600px;padding-top:5px;color:#dfb701;text-align:center; font-weight:bold;"> NIT: 
           @if(isset(FuncionesGlobales::sitio()->nit))
            @if(FuncionesGlobales::sitio()->nit != "")
              {{((FuncionesGlobales::sitio()->nit))}}
            @else
              800199453
            @endif
           @else
             800199453
           @endif
         </span><!-- nit de soluciones -->
       </div>

       <div class="datos_candidato" style="font-size:11px;padding:3px;word-wrap: break-word;top:95px;height:auto; width:45%; position: relative;z-index:3; float:right; margin-right:60px; font-weight:500; text-align:left;">
         <span>
           {{ucwords(mb_strtolower($candidato->nombres)).' '.ucwords(mb_strtolower($candidato->primer_apellido)).' '.ucwords(mb_strtolower($candidato->segundo_apellido))}} <br>
           cedula: {{$candidato->numero_id}} <br>
           Nit: {{$req->nit}}<br>
           {{$req->nombre_cliente}}<br>
           {{$req->cargo}}<br>
           <li style="list-style: none;"> Fecha ingreso: {{ isset($req->fecha_inicio_contrato) ? date('d-m-Y',strtotime($req->fecha_inicio_contrato)) : ""}} </li>
         </span>

       </div>

      @if( $req->id_cliente == '370' )
      <div style="position: absolute; top: 200px; left: 30px; z-index: 4;">
            <span>
                <img style="width:65px;height:70px;" alt="logo cliente" src="{{asset('configuracion_sitio/cliente_370.jpeg')}}" />
            </span>

       </div>
       <div style="position: absolute; top: 200px; left: 95px; z-index: 4;">
            <span>
                <img style="width:65px;height:70px;" alt="logo cliente" src="{{asset('configuracion_sitio/cliente_370.jpg')}}" />
            </span>

       </div>          
      @endif

       @if( isset($qrcode) )
       <div style="position: absolute; top: 210px; left: 160px; z-index: 4;">
            <span>
                <img style="width:75px;height:70px;" alt="codigo QR" src="data:image/png;base64,{!!$qrcode!!}" />
            </span>

       </div>          
        @endif

       
     </div>
     </div>

  </body>
</html>