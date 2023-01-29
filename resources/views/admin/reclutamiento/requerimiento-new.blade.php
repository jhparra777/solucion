@extends("admin.layout.master")
@section('contenedor')
    
    {{-- Header --}}
    @include('admin.layout.includes._section_header_breadcrumb', ['page_header' => "Requerimientos"])

    <div class="row">
        {{-- <div class="col-md-12 mb-2">
            <h3>Requerimientos</h3>
        </div> --}}

        @if(Session::has("mensaje_success"))
            <div class="col-md-12" id="mensaje-resultado">
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ Session::get("mensaje_success") }}
                </div>
            </div>
        @endif
    </div>

    {!! Form::model(Request::all(), ["route" => "admin.reclutamiento", "method" => "GET", "class" => "mb-2"]) !!}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="numReq">
                        @if(route('home') == "https://gpc.t3rsc.co") Nombre del Proceso @else Número requerimiento @endif:
                    </label>

                    {!! Form::text("num_req", null, [
                        "id" => "numReq",
                        "class" => "form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                        "placeholder" => "Número de requerimiento"
                    ]); !!}
                </div>
            </div>

            @if(route('home') != "https://komatsu.t3rsc.co")
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cliente_id">Clientes:</label>

                        {!! Form::select('cliente_id', $clientes, null, [
                            'id' => 'cliente_id',
                            'class' => 'form-control js-select-2-basic | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300'
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cargo_id">Cargo:</label>

                        {!! Form::select("cargo_id", [], null, [
                            "class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                            "readonly" => "readonly",
                            "id" => "cargo_id"
                        ]); !!}
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cargo_id">Cargo:</label>

                        {!! Form::select('cargo_id', $listaCargos, null, [
                            'id' => 'cargo_id',
                            'class' => 'form-control js-select-2-basic | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300'
                        ]) !!}
                    </div>
                </div>
            @endif

            @if(route("home") != "https://komatsu.t3rsc.co")
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tipo_proceso_id">Tipo de Proceso:</label>       

                        {!! Form::select('tipo_proceso_id', $listaProcesos, null, [
                            'id' => 'tipo_proceso_id',
                            'class' => 'form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300'
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="cedula">Cédula:</label>

                        {!! Form::text("cedula", null, [
                            "id" => "cedula",
                            "class" => "form-control solo-numero | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300",
                            "placeholder" => "Número de documento"
                        ]); !!}
                    </div>
                </div>
            @else
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="area_id">Área:</label>       
                   
                        {!! Form::select('area_id', $areas, null, [
                            'id' => 'area_id',
                            'class' => 'form-control js-select-2-basic | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300'
                        ]) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="sede_id">sede:</label>
                        
                        {!! Form::select('sede_id', $sede, null, [
                            'id' => 'sede_id',
                            'class' => 'form-control js-select-2-basic | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300'
                        ]) !!}
                    </div>
                </div>
            @endif

            @if(route("home") == "https://vym.t3rsc.co" || route("home") == "https://listos.t3rsc.co")
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="agencia" class="control-label">Agencia:</label>

                        {!! Form::select('agencia', $agencias, null, ['id' => 'agencia', 'class' => 'form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300']) !!}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="inputEmail3" class="control-label">Estado req:</label>

                        {!! Form::select("estado_id", $estados_requerimiento, null, ["class" => "form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300"]); !!}
                    </div>
                </div>
            @endif

            @if(route("home") == "https://komatsu.t3rsc.co")
                <div class="col-md-6 form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Solicitante:</label>
                    
                    <div class="col-sm-10">
                        {!! Form::select('solicitante',$solicitante, null, ['id' => 'solicitante', 'class' => 'form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300']) !!}
                    </div>
                </div>
            @endif

            <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-green">
                    Buscar <i aria-hidden="true" class="fa fa-search"></i>
                </button>

                <a class="btn btn-danger | tri-px-2 tri-br-2 tri-border--none tri-transition-300 tri-red" href="{{ route("admin.reclutamiento") }}">
                    Limpiar
                </a>
            </div>
        </div>
    {!! Form::close() !!}

    <div class="panel panel-default">
        <div class="panel-body">
            
                <div class="tabla table-responsive">
                    <table class="table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th>Num Req</th>
                                <th>Cliente</th>
                                <th>Tipo Proceso</th>
                                <th>Ciudad</th>
                                <th>Cargo</th>
                                <th># Vacantes</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Oportuna</th>
                                <th>Dias gestión</th>
                                <th>Estado</th>
                                <th>Vacantes Pendientes</th>
                                <th>Tarea</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($requerimientos as $requerimiento)
                                <tr>
                                    <td><b>{{ $requerimiento->id }}</b></td>
                                    <td>@if(!empty($requerimiento->nombre_cliente_req())) {{ $requerimiento->nombre_cliente_req() }} @endif</td>

                                    <td>@if(!empty($requerimiento->tipo_proceso_req())) {{ $requerimiento->tipo_proceso_req() }} @endif</td>

                                    <td>@if(!empty($requerimiento->ciudad_req())) {{ $requerimiento->ciudad_req() }} @endif</td>
                                 
                                    <td>@if(!empty($requerimiento->cargo_req())) {{ $requerimiento->cargo_req() }} @endif</td>

                                    <td>{{ $requerimiento->num_vacantes }}</td>

                                    <td>{{ $requerimiento->created_at }}</td>
                                 
                                    <td>{{ $requerimiento->fecha_ingreso }}</td>

                                    <td>
                                        <?php
                                            $m = 'Carbon\Carbon';
                                            
                                            $date1 = date('Y-m-d', strtotime($requerimiento->created_at));
                                            $date2 = date('Y-m-d', strtotime($requerimiento->fecha_ingreso));
                                            //$diff = $fecha1->diff($fecha2);
                                            $g = $m::parse($date1)->diffInWeekdays($date2);
                                        ?>
                                        {{ $g }}
                                    </td>
                                 
                                    {{--<td>@if(!empty($requerimiento->estadoRequerimiento())) {{$requerimiento->estadoRequerimiento()->estado_nombre}} @endif</td>--}}
                                    
                                    <td>
                                        {{ $requerimiento->estados->last()->estado_tipo->descripcion }}
                                    </td>

                                    <td>
                                        <b>
                                            @if(isset($sitio))
                                                @if($sitio->asistente_contratacion == 1 && $requerimiento->firma_cargo == 1)
                                                    {{ $requerimiento->vacantes_reales_asistente }}
                                                @else
                                                    {{ $requerimiento->vacantes_reales }}
                                                @endif
                                            @else
                                                {{ $requerimiento->vacantes_reales }}
                                            @endif
                                        </b>
                                    </td>

                                    @if(!empty($requerimiento->estados->last()->estado)) 
                                        @if(!in_array($requerimiento->estados->last()->estado,[22, 3, 1, 16, 17, 19]))
                                            <td>
                                                <a class="btn btn-default | tri-br-2 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-200 tri-hover-out-purple"  href="{{ route("admin.gestion_requerimiento", ["req_id" => $requerimiento->id]) }}">
                                                    Gestionar
                                                </a>
                                            </td>
                                        @else
                                            <td>
                                                CERRADO / 
                                                <a href="{{ route("admin.gestion_requerimiento", ["req_id" => $requerimiento->id]) }}">
                                                    VER PROCESO
                                                </a>
                                            </td>
                                        @endif
                                    @else
                                        <td>CERRADO</td>
                                    @endif
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No se encontraron registros</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
          
        </div>
    </div>

    <div>
        {!! $requerimientos->appends(Request::all())->render() !!}
    </div>

    <script type="text/javascript">
        $(function () {
            $('.js-select-2-basic').select2({
                placeholder: 'Selecciona o busca'
            });

            $("#cliente_id").change(function() {
                var valor = $(this).val();
                
                $.ajax({
                    url: "{{ route('admin.selectCargoCliente') }}",
                    type: 'POST',
                    data: {id: valor},
                    success: function(response){
                        var data = response.cargos;
                        $('#cargo_id').empty();
                        $('#cargo_id').removeAttr('readonly');
                        $('#cargo_id').append("<option value=''>Seleccionar</option>");
                        $.each(data, function(key, element) {
                            $('#cargo_id').append("<option value='" + element.id + "'>" + element.descripcion + "</option>");
                        });
                    }
                });
            });
            
            $(document).on("click",".asignar_psicologo", function () {
                var req_id = $(this).data("req_id");
                var cliente_id = $(this).data("cliente_id");

                $.ajax({
                    data: {req_id: req_id, cliente_id: cliente_id},
                    url: "{{ route('admin.asignar_psicologo') }}",
                    success: function (response) {
                        $("#modal_peq").find(".modal-content").html(response);
                        $("#modal_peq").modal("show");
                    }
                });
            }); 

            $(document).on("click", "#guardar_asignacion", function () {
                $(this).prop("disabled", false)

                $.ajax({
                    type: "POST",
                    data: $("#fr_asig").serialize(),
                    url: "{{ route('admin.asignar_psicologo_guardar') }}",
                    success: function(response) {
                        if(response.success) {
                            $("#modal_peq").find(".modal-content").html(response.view);
                            $("#modal_peq").modal("show");
                            $("#modal_peq").modal("hide");

                            mensaje_success("Asignación realizada");
                            location.reload();
                         }else {
                            $("#modal_peq").find(".modal-content").html(response.view);
                            $("#modal_peq").modal("show");
                            $("#modal_peq").modal("hide");

                            mensaje_danger("Ya se le hizo la asignación al analista");
                        }
                    }
                });
            });
       });
    </script>
@stop