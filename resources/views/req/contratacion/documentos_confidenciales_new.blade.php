@extends("req.layout.master")
@section('contenedor')
    <?php $cargo = $requerimiento->cargo_especifico()->descripcion ?>

    {{-- HEADER --}}
    @include('req.layout.includes._section_header_breadcrumb', ['page_header' => "Documentos confidenciales | $datos_candidato->nombres $datos_candidato->primer_apellido $datos_candidato->segundo_apellido", 'more_info' => "<b>Requerimiento</b> $req | <b>Tipo Proceso</b> $requerimiento->tipo_proceso | <b>Cargo</b> $cargo"])

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="tabla table-responsive">
                        <table class="table table-bordered table-hover" id="data-table">
    	                    <thead>
    	                        <tr>
                                    <th>Documento</th>
                                    <th> Usuario Cargó </th>
                                    <th> Fecha Carga </th>
                                    <th>Status</th>
                                    <th>Acción</th>
    	                        </tr>
    	                    </thead>

                            <tbody style="text-transform: uppercase;">
                                @foreach($tipo_documento as $tipo)
                                {{-- {{ dd($tipo_documento) }} --}}
                                    <tr>
                                        <td>{{ $tipo->descripcion }}</td>
										<td> {{$tipo->usuario_gestiono}} </td>
										<td> {{($tipo->gestiono)?date("d-m-Y",strtotime($tipo->fecha_carga)):''}} </td>

                                        @if($tipo->nombre!="")
                                            <td class="text-center">
                                                <i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
                                            </td>

                                            <td>
                                                <div class="btn-group">
                                                    <button
                                                        type="button"
                                                        class="btn btn-info btn-sm btn-block dropdown-toggle | tri-fs-12 tri-txt-purple tri-bg-white tri-bd-purple tri-transition-300 tri-hover-out-purple"
                                                        data-toggle="dropdown"
                                                        aria-haspopup="true"
                                                        aria-expanded="false"
                                                        >
                                                        {{-- {{ dd($doc->nombre_real) }} --}}
                                                        <span data-toggle="tooltip" data-container="body"  title="{{ $tipo->nombre_real }}">Documento {{$contador}}</span>
                                                        {{-- <span class="caret"></span> --}}
                                                    </button>

                                                    <ul class="dropdown-menu pd-0">
                                                        <div class="btn-group-vertical" role="group" aria-label="..." style="width: 100%;">
                                                            <a  class="btn btn-default btn-sm btn-block | text-left tri-bd--none tri-br-0 tri-txt-gray-600 tri-hover-bd--none" href='{{ route("view_document_url", encrypt("recursos_documentos_verificados/"."|".$tipo->nombre."|".$tipo->id)) }}' target="_blank">
                                                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                                                Ver
                                                            </a>

                                                            <a  class="btn btn-default btn-sm btn-block | text-left tri-bd--none tri-br-0 tri-txt-gray-600 tri-hover-bd--none" href="{{ route('admin.descargar_recurso', ['recursos_documentos_verificados', $tipo->nombre]) }}" target="_blank" title="Descargar archivo">
                                                                <i class="fa fa-download" aria-hidden="true"></i>
                                                                Descargar
                                                            </a>
                                                        </div>
                                                    </ul>
                                                </div>
                                            </td>
										@else
											<td class="text-center">
                                                <i class="fa fa-times" aria-hidden="true" style="color:red;">
                                            </td>
                                            <td>

                                            </td>
										@endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="panel-footer">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            {{-- <button class="btn btn-info | tri-br-2 tri-fs-12 tri-txt-gray tri-bg-white tri-bd-gray tri-transition-300 tri-hover-out-gray" id="cargarDocumentoConfi" type="button">
                                <i class="fa fa-cloud-upload"></i> Cargar documento
                            </button> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 text-right">
            <button class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-200" onclick="window.history.back();" title="Volver">Volver</button>
        </div>
    </div>

    <script>
        $('#data-table').DataTable({
            "responsive": true,
            "columnDefs": [
                { responsivePriority: 1, targets: 0 },
                { responsivePriority: 2, targets: -1 }
            ],
            "paginate": true,
            "lengthChange": true,
            "filter": true,
            "sort": true,
            "info": true,
            initComplete: function() {
                this.api().column(0).each(function() {
                    let column = this

                    $('#estado_id').on('change', function() {
                        var val = $(this).val()
                        column.search(val ? '^' + val + '$' : '', true, false).draw()
                    })
                })
            },
            "autoWidth": true,
            "order": [[ 1, "desc" ]],
            "language": {
                "url": '{{ url("js/Spain.json") }}'
            }
        })

        $(function(){
            $("#cargarDocumentoConfi").on("click", function() {
                $.ajax({
                    url: "{{ route('admin.cargarDocumentoAdminConfidencial') }}",
                    data: {
                        user_id: {{ $candidato_id }},
                        req: {{ $req }}
                    },
                    type: "POST",
                    beforeSend: function() {
                    },
                    success: function(response) {
                        $("#modalTriLarge").find(".modal-content").html(response)
                        $("#modalTriLarge").modal("show")
                    }
                })
            })
        })
    </script>
@stop