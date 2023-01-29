@extends("admin.layout.master")
@section('contenedor')

<h3>Evaluación SST</h3>
<h5 class="titulo1">Información Candidato</h5>
<table class="table table-bordered">
    <tr>
        <th>Cedula</th>
        <td>{{$candidato->numero_id}}</td>
        <th>Nombres</th>
        <td>{{$candidato->nombres." ".$candidato->primer_apellido." ".$candidato->segundo_apellido}}</td>
    </tr>
    <tr>
        <th>Telefono</th>
        <td>{{$candidato->telefono_fijo}}</td>
        <th>Movil</th>
        <td>{{$candidato->telefono_movil}}</td>
    </tr>
    <tr>
        <th>Email</th>
        <td>{{$candidato->email}}</td>
    </tr>

</table>

<table class="table table-bordered tbl_info">
    <tr>
        <th colspan="7">Estado del proceso</th>
    </tr>
    <tr>
      <th>#req</th>
      <th> Fecha Inicio </th>
      <th>Estado</th>
      <th>puntos</th>
      <th></th>
    </tr>
   @if(isset($evaluaciones))
    @foreach($evaluaciones as $evaluacion)
     <tr>
       <td>{{$evaluacion->id_req}}</td>
       <td>{{date("d-m-Y",strtotime($evaluacion->created_at))}}</td>
       <td>{{((FuncionesGlobales::puntuacion_sst($evaluacion) > 80)?"Calificado":"Repetir Prueba")}}</td>
       <td>{{(FuncionesGlobales::puntuacion_sst($evaluacion))}}%</td>
     </tr>
    @endforeach
   @endif
</table>

<button type="button" class="btn btn-warning" id="cambiar_estado"> Cambiar Estado </button>
<button type="button" class="btn btn-info" id="nueva_evaluacion"> Realizar Evaluación </button>

<div class="row hidden">

    <h3 class="titulo1">Evaluaciones Realizadas</h3>


<script>
    $(function () {
     
     var ruta = "{{route('admin.gestion_requerimiento',$candidato->requerimiento_id)}}";

        $("#cambiar_estado").on("click", function () {
            $.ajax({
                type: "POST",
                data: "ref_id={{$candidato->ref_id}}&modulo=pruebas",
                url: "{{route('admin.cambiar_estado_view')}}",
                success: function (response) {
                    console.log("af");
                    $("#modal_peq").find(".modal-content").html(response);
                    $("#modal_peq").modal("show");

                }
            });
        });

        $(document).on("click", "#guardar_estado", function () {
            $.ajax({
                data: $("#fr_cambio_estado").serialize(),
                url: "{{route('admin.guardar_cambio_estado')}}",
                success: function (response) {
                    if (response.success) {
                        mensaje_success("Estado actualizado.. Espere sera redireccionado");
                       // window.location.href = "{{ route('admin.pruebas')}}";
                        setTimeout(function(){
                        location.href=ruta; }, 3000);

                    } else {
                        $("#modal_peq").find(".modal-content").html(response.view);
                    }

                }
            });
        });

        $("#nueva_evaluacion").on("click", function () {

            $.ajax({
                type: "POST",
                data: "candidato_req={{$candidato->req_candidato}}",
                url: "{{ route('realizar_evaluacion_sst') }}",
                success: function (response) {
                  $('#modal_gr').modal({ backdrop: 'static', keyboard: false });
                  $("#modal_gr").find(".modal-content").html(response);
                  $("#modal_gr").modal("show");
                }
            });
        });

        $(document).on("click", "#guardar_evaluacion", function () {
            $(this).prop("disabled", true)
            var formData = new FormData(document.getElementById("fr_evaluacion"));
            $.ajax({
                url: "{{route('admin.guardar_prueba')}}",
                type: "post",
                dataType: "html",
                data: formData,
                cache: false,
                contentType: false,
                processData: false
            }).done(function (res) {
                var res = $.parseJSON(res);
              $("#guardar_nueva_prueba").removeAttr("disabled");

                if(res.success) {

                    if(res.final==1){ //prueba definitiva 6gh
                      mensaje_success("Prueba Guardada con Exito!!");
                       setTimeout(function(){
                        location.href=ruta; }, 3000);
                   }
                    else{
                      window.location.href = '{{ route("admin.gestionar_prueba",[$candidato->ref_id]) }}';
                    }
                   
                } else {
                    $("#modal_peq").find(".modal-content").html(res.view);
                }

            });
        });

        $(".prueba_utilizada").on("click", function () {
            var prueba = $(this).data("prueba");
            var req = $(this).data("req");
            var btn = $(this);
            
            $.ajax({
                type: "POST",
                data: {req_id: req, prueba_id: prueba},
                url: "{{ route('admin.registra_proceso_entidad') }}",
                success:function(response){
                    mensaje_success("Prueba no mostrada!!");
                   window.location.href = '{{ route("admin.gestionar_prueba",[$candidato->ref_id]) }}'
                    
                }
            });
        });
         $(".prueba_utilizada2").on("click", function () {
            var prueba = $(this).data("prueba");
            var req = $(this).data("req");
            var btn = $(this);
            
            $.ajax({
                type: "POST",
                data: {req_id: req, prueba_id: prueba},
                url: "{{ route('admin.registra_proceso_entidad2') }}",
                success:function(response){
                    mensaje_success("Prueba  mostrada!!");
                    window.location.href = '{{ route("admin.gestionar_prueba",[$candidato->ref_id]) }}'
                    
                }
            });
        });
    });
</script>
@stop