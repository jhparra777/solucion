@extends("admin.layout.master")
@section('contenedor')

@include('admin.layout.includes._section_header_breadcrumb', ['page_header' => "Lista Adelanto de Nómina"])

<div class="col-md-6">
    <div id="accordion">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="cursor: pointer;">
                    <h3 class="panel-title text-white">
                        Permitir solicitar adelanto de nómina
                    </h3>
                </a>
            </div>
            <input type="hidden" name="edit" id="edit" value="false">
            <div id="collapseOne" class="collapse in" aria-labelledby="headingUno" data-parent="#accordion">
                <div class="panel-body">
                    <div class="form-group">
                        <label for="cedula" class="control-label">Cédula</label>

                        {!! Form::text("cedula",null,["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300","placeholder"=>"Ingrese la cédula", "id" => "cedula", "required" => "required"]); !!}
                    </div>
                    <div class="form-group">
                        <label for="permiso" class="control-label">Permiso para hacer solicitudes</label>

                        {!! Form::select("permiso", ['' => 'Seleccione', '1' => 'Permitir', '0' => 'No permitir'], null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "permiso", "required" => "required"]); !!}
                    </div>
                    <div id="div_motivo" class="form-group" hidden>
                        <label for="motivo_termino_id" class="control-label">Motivo</label>

                        {!! Form::select("motivo_termino_id", $tipos_restricciones, null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "motivo_termino_id", "required" => "required"]); !!}
                    </div>
                    <div id="div_fecha_fin_contrato" class="form-group" hidden>
                        <label for="fecha_fin_contrato" class="control-label">Fecha fin de contrato</label>

                        {!! Form::text("fecha_fin_contrato", null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "fecha_fin_contrato", "required" => "required", "readonly" => "readonly"]); !!}
                    </div>
                    <div id="div_otro_motivo" class="form-group" hidden>
                        <label for="otro_motivo" class="control-label">Observación otro motivo</label>

                        {!! Form::text("otro_motivo", null, ["class"=>"form-control | tri-br-1 tri-fs-12 tri-input--focus tri-transition-300", "id" => "otro_motivo", "required" => "required"]); !!}
                    </div>
                    <button class="btn btn-default btn-block | tri-br-2 tri-txt-green tri-bg-white tri-bd-green tri-transition-200 tri-hover-out-green" id="btn_agregar" type="button">Agregar</button>
                    <button class="btn btn-default btn-block | tri-px-2 text-white tri-br-2 tri-border--none tri-transition-200 tri-red" id="btn_cancelar" type="button">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div id="accordion-3">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <a data-toggle="collapse" data-target="#collapseTres" aria-expanded="true" aria-controls="collapseTres" style="cursor: pointer;">
                    <h3 class="panel-title text-white">
                        Permiso contratados, adelanto de nómina
                    </h3>
                </a>
            </div>
            <div id="collapseTres" class="collapse in" aria-labelledby="headingTres" data-parent="#accordion-3">
                <div class="panel-body">
                    <table class="table table-hover table-bordered" id="table_with_users">
                        <thead>
                            <tr>
                                <th>Cédula</th>
                                <th>Nombre y apellido</th>
                                <th>Permiso</th>
                                <th>Motivo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($datos_lista_permiso as $dato)
                                <tr>
                                    <td>{{ $dato->numero_id }}</td>
                                    <td>{{ $dato->nombres . ' ' . $dato->primer_apellido }}</td>
                                    <td class="text-center">
                                        @if ($dato->permiso_solicitud == '1')
                                            <span title="Puede hacer solicitudes de adelanto de nómina"><i class="fa fa-check-circle-o fa-2x text-success"></i></span>
                                        @else
                                            <span title="No puede realizar solicitudes de adelanto de nómina"><i class="fa fa-times fa-2x text-red"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $dato->descripcion }}</td>
                                    <td>
                                        <button class="btn btn-default | tri-br-2 tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple btn_editar" data-cedula="{{ $dato->numero_id }}" data-permiso="{{ $dato->permiso_solicitud }}" data-motivo="{{ $dato->motivo_termino_id }}" data-fecha="{{ $dato->fecha_fin_contrato }}" data-otromotivo="{{ $dato->observacion_otro_motivo }}" type="button">Editar</button>
                                    </td>
                                </tr>
                            @empty
                                {{-- Nada --}}
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

<script type="text/javascript">
    $(function() {
        $('#table_with_users').DataTable({
            'stateSave': true,
            "lengthChange": false,
            "responsive": true,
            "paginate": true,
            "autoWidth": true,
            "searching": true,
            "order": [[0,"desc"]],
            "lengthMenu": [[10, 25, -1], [10, 25, "All"]],
            "language": {
                "url": '{{ url("js/Spain.json") }}'
            }
        });

        var confDatepicker2 = {
            altFormat: "yy-mm-dd",
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            buttonImage: "img/gifs/018.gif",
            buttonImageOnly: true,
            autoSize: true,
            dayNames: ["Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado"],
            monthNamesShort: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            dayNamesMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa"],
            yearRange: "1930:2050"
        };
        $("#fecha_fin_contrato").datepicker(confDatepicker2);

        $('#permiso').change(function() {
            if ($('#permiso').val() == '0') {
                $('#div_motivo').show();
            } else {
                $('#motivo_termino_id').val('');
                $('#motivo_termino_id').trigger('change');
                $('#div_motivo').hide();
            }
        });

        $('#motivo_termino_id').change(function() {
            if ($('#motivo_termino_id').val() == '') {
                $('#otro_motivo').val('');
                $('#fecha_fin_contrato').val('');
                $('#div_otro_motivo').hide();
                $('#div_fecha_fin_contrato').hide();
            } else if($('#motivo_termino_id').val() == '1') {
                $('#otro_motivo').val('');
                $('#fecha_fin_contrato').val('');
                $('#div_otro_motivo').hide();
                $('#div_fecha_fin_contrato').show();
            } else if($('#motivo_termino_id').val() == '2') {
                $('#otro_motivo').val('');
                $('#fecha_fin_contrato').val('');
                $('#div_otro_motivo').show();
                $('#div_fecha_fin_contrato').hide();
            }
        });

        $('.btn_editar').click(function() {
            $('#cedula').val($(this).data("cedula"));
            $('#permiso').val($(this).data("permiso"));
            if ($(this).data("permiso") == '0' || $(this).data("permiso") == null || $(this).data("permiso") == '') {
                $('#motivo_termino_id').val($(this).data("motivo"));
                $('#motivo_termino_id').trigger('change');
                $('#otro_motivo').val($(this).data("otromotivo"));
                $('#fecha_fin_contrato').val($(this).data("fecha"));
                $('#div_motivo').show();
            } else {
                $('#motivo_termino_id').val('');
                $('#div_motivo').hide();
            }
        });

        $('#btn_cancelar').click(function() {
            $('#cedula').val('');
            $('#permiso').val('');
            $('#motivo_termino_id').val('');
            $('#motivo_termino_id').trigger('change');
            $('#div_motivo').hide();
        });

        $('#btn_agregar').click(function() {
            if ($('#cedula').smkValidate() && $('#permiso').smkValidate()) {
                let cedula = $('#cedula').val();
                let men = "Confirma que deseas HABILITAR los adelantos de nómina a la cédula " + cedula;
                let mensaje_confirmacion = "Se HABILITÓ correctamente la cédula " + cedula + " para que pueda solicitar adelantos de nómina";
                if ($('#permiso').val() == '0') {
                    if(!$('#motivo_termino_id').smkValidate()) {
                        return
                    } else {
                        if($('#motivo_termino_id').val() == '1') {
                            if(!$('#fecha_fin_contrato').smkValidate()) { return }
                        } else if($('#motivo_termino_id').val() == '2') {
                            if(!$('#otro_motivo').smkValidate()) { return }
                        }
                    }
                    men = "Confirma que deseas INHABILITAR los adelantos de nómina a la cédula " + cedula;
                    mensaje_confirmacion = "Se INHABILITÓ correctamente la cédula " + cedula + " para que no pueda solicitar adelantos de nómina";
                }
                let motivo_termino_id = $('#motivo_termino_id').val();
                let permiso = $('#permiso').val();
                let fecha_fin_contrato = $('#fecha_fin_contrato').val();
                let otro_motivo = $('#otro_motivo').val();

                swal("¿Estás seguro?", men, "warning", {
                    buttons: {
                        cancelar: {text: "Cancelar", className: 'btn btn-default'},
                        agregar: {text: "Confirmar", className:'btn btn-warning'}
                    },
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                    allowOutsideClick: false,
                }).then((value) => {
                    switch (value) {
                        case "agregar":
                            $.ajax({
                                url: "{{ route('admin.agregar_cedula_adelanto_nomina') }}",
                                type: 'POST',
                                data: {
                                    cedula: cedula,
                                    motivo_termino_id: motivo_termino_id,
                                    permiso: permiso,
                                    fecha_fin_contrato: fecha_fin_contrato,
                                    otro_motivo: otro_motivo
                                },
                                beforeSend: function(){
                                    $.smkAlert({
                                        text: 'Guardando la información...',
                                        type: 'info'
                                    })
                                },
                                success: function(response){
                                    $('#cedula').val('');
                                    $('#permiso').val('');
                                    $('#motivo_termino_id').val('');
                                    $('#motivo_termino_id').trigger('change');
                                    swal("¡Operación exitosa!", mensaje_confirmacion, "success");
                                    setTimeout(() => {
                                        window.location.reload(true)
                                    }, 2000)
                                },
                                error: function(response){
                                    $.smkAlert({
                                        text: 'Ha ocurrido un error, intente nuevamente.',
                                        type: 'danger'
                                    });
                                }
                            });
                        break;
                    }
                });
            }
        });
    })

</script>
@stop