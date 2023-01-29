@extends("admin.layout.master")
@section("contenedor")

    {{-- Header --}}
    @include('admin.layout.includes._section_header_breadcrumb', ['page_header' => "Candidatos exámenes médicos"])
    <style type="text/css">
        th,td{
            text-align: center;
        }
    </style>
    
    {!! Form::model(Request::all(), ["route"=>"admin.examenes_medicos","id" => "examenes_medicos", "method" => "GET"]) !!}
        <div class="row">
            <div class="col-md-6  form-group">
                <label for="codigo" class="control-label">Número de Requerimiento:</label>

                {!! Form::text("codigo",null,["class"=>"form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Número Requerimiento", "id" => "codigo"]); !!}
            </div>

            <div class="col-md-6  form-group">
                <label for="cedula" class="control-label">Número de Cédula:</label>

                {!! Form::text("cedula",null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Número Cédula", "id" => "cedula"]); !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label for="fecha_orden" class="control-label">Fecha envío a exámenes:</label>

                {!! Form::text("fecha_orden",null,["class"=>"range form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Fecha envío a exámenes", "autocomplete"=>"off", "id"=>"fecha_orden"]); !!}
            </div>

            <div class="col-md-6 form-group">
                <label for="sitio_trabajo_autocomplete" class="control-label">Ciudad Trabajo: <span></span></label>

                {!! Form::hidden("pais_id", null, ["class" => "form-control", "id" => "pais_id"]) !!}
                {!! Form::hidden("departamento_id", null, ["class" => "form-control", "id" => "departamento_id"]) !!}
                {!! Form::text("ciudad_id", null, ["style" => "display: none;", "class" => "form-control", "id" => "ciudad_id"]) !!}
                {!! Form::text("sitio_trabajo",null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Seleccionar una opción de la lista desplegable", "id" => "sitio_trabajo_autocomplete"]); !!}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6  form-group">
                <label for="orden_id" class="control-label">Número de Orden:</label>

                {!! Form::text("orden_id",null,["class"=>"form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "placeholder" => "Número orden", "id" => "orden_id"]); !!}
            </div>

            <div class="col-md-6  form-group">
                <label for="cliente_id" class="control-label">Cliente:</label>

                {!! Form::select("cliente_id", $clientes, null, ["class" => "form-control js-example-basic-single | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"]); !!}
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green">
                    Buscar <i aria-hidden="true" class="fa fa-search"></i>
                </button>

                <a class="btn btn-danger | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-red" href="{{ route("admin.examenes_medicos") }}">
                    Limpiar
                </a>
            </div>
        </div>

        {{--<a class="btn btn-info" href="Javascript:;" onclick="return redireccionar_registro('ref_id[]', this, 'url')">Gestionar Documentación</a>--}}
    {!! Form::close() !!}
    <br>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table-responsive table table-bordered" id="data-table">
                        <thead>
                            <tr >
                                <th>Requerimiento</th>
                                <th>Cliente</th>
                                <th>Ciudad</th>
                                <th>Cargo</th>
                                <th>Cédula</th>
                                <th>Nombres y Apellidos</th>
                               
                                <th># Orden</th>
                                <th>Fecha envío a exámenes</th>
                                <th>Fecha tentativa ingreso</th>
                                <th>Usuario que envió</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if($candidatos->count() == 0)
                                <tr>
                                    <td colspan="11"> No se encontraron registros</td>
                                </tr>
                            @endif
                            
                            @foreach($candidatos as $candidato)
                                <tr>
                                    <td>{{ $candidato->requerimiento }}</td>
                                    <td>{{ $candidato->cliente }}</td>
                                    <td>{{ $candidato->ciudad }}</td>
                                    <td>{{ $candidato->cargo }}</td>
                                    <td>{{ $candidato->numero_id }}</td>
                                    <td>{{ $candidato->candidato }} {{ $candidato->primer_apellido }} {{ $candidato->segundo_apellido }}</td>
                                    
                                    <td>{{ $candidato->orden }}</td>
                                    <td>{{ $candidato->created_at }}</td>
                                    <td>{{ $candidato->fecha_tentativa_ingreso }}</td>
                                    <td>{{ $candidato->user_envio_orden}}</td>

                                    <td>
                                        @if($candidato->estado=="1")
                                            <a class="btn btn-default | tri-br-2 tri-txt-gray tri-bg-white tri-bd-gray tri-transition-200 tri-hover-out-gray" href="{{ route('admin.gestionar_documentos_medicos', ['ref_id' => $candidato->orden]) }}">
                                                Gestionar documentación <i aria-hidden="true" class="fa fa-plus"></i>
                                            </a>
                                        @else
                                            <button class="btn btn-warning editar_concepto | tri-br-2 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-200 tri-hover-out-purple" data-ref="{{$candidato->orden}}">
                                                Editar orden <i aria-hidden="true" class="fa fa-pencil-square-o"></i>
                                            </button> 
                                        @endif  
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<script type="text/javascript">
    $(function(){
        var table = $('#data-table').DataTable({
            "responsive": true,
            "paginate": true,
            "lengthChange": true,
            "deferRender":true,
            "filter": true,
            "sort": true,
            "info": true,
            "lengthMenu": [[10,20, 25, -1], [10,20, 25, "All"]],
            "autoWidth": true,
            "language": {
                "url": '{{ url("js/Spain.json") }}'
            }
        });

        $('.js-example-basic-single').select2({
            placeholder: 'Selecciona o busca un cliente'
        });

         $('#sitio_trabajo_autocomplete').autocomplete({
                serviceUrl: '{{ route("autocomplete_cuidades") }}',
                autoSelectFirst: true,
                onSelect: function (suggestion) {
                    $(this).css("border-color","rgb(210,210,210)");
                    $("#error_ciudad_expedicion").hide();
                     $(this).css("border-color","rgb(210,210,210)");
                    $("#pais_id").val(suggestion.cod_pais);
                    $("#departamento_id").val(suggestion.cod_departamento);
                    $("#ciudad_id").val(suggestion.cod_ciudad);
                }
            });

            $('#sitio_trabajo_autocomplete').keypress(function(){
                $(this).css("border-color","red");
                $("#error_ciudad_expedicion").show();
                $("#select_expedicion_id").val("no");
            });

            $('.editar_concepto').click(function(){
                var orden=$(this).data('ref');
            $.ajax({

                type: "POST",
                url: "{{ route('admin.cambiar_concepto_medico') }}",
                data: {
                    orden : orden,
                },
               
                success: function(response) {
                    $("#modal_peq").find(".modal-content").html(response);
                    $("#modal_peq").modal("show");
                }
             });

            });


    })
</script>
@stop