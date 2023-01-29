@extends("req.layout.master")
@section('contenedor')

<div class="row">
    <div class="col-sm-6">
        <h2>Documentos confidenciales</h2>

        <h4>{{ $datos_candidato->nombres }} {{ $datos_candidato->primer_apellido }} {{ $datos_candidato->segundo_apellido }}</h4>
		<h4><b>#Req:</b> {{ $requerimiento->id }}</h4>
		<h4><b>#T. Proceso:</b> {{ $requerimiento->tipo_proceso }}</h4>
        <h4><b>Cargo:</b> {{ $requerimiento->cargo_especifico()->descripcion }}</h4>
    </div>
</div>

<div class="col-right-item-container">
    <div class="container-fluid">      
        <div class="col-md-12 col-sm-12 col-xs-12">
			<div id="submit_listing_box">
				<div class="form-alt">
					<div class="row">
						<div class="tabla table-responsive">
							<table class="table table-bordered table-hover ">
								<thead>
									<tr>
									   <th class=""> Documento </th>
									   <th> Usuario Cargó </th>
                                       <th> Fecha Carga </th>
									   <th class=""> Status </th>
									</tr>
								</thead>

								<tbody style="text-transform: uppercase;">
									@foreach($tipo_documento as $tipo)
										<tr>
											<td>{{ $tipo->descripcion }}</td>
											<td> {{$tipo->usuario_gestiono}} </td>
											<td> {{($tipo->gestiono)?date("d-m-Y",strtotime($tipo->fecha_carga)):''}} </td>
											<td>
												@if($tipo->nombre!="")
													<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
													<a href='{{ asset("recursos_documentos_verificados/$tipo->nombre") }}' target="_blank">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>

													<a href='{{ route('admin.descargar_recurso', ['recursos_documentos_verificados', $tipo->nombre]) }}' target="_blank" title="Descargar archivo">
														<i class="fa fa-download" aria-hidden="true"></i>
													</a>
												@else
													<i class="fa fa-times" aria-hidden="true" style="color:red;">
												@endif
											</td>
										</tr>
									@endforeach

									{{--@if ($tipo_documento_aparte != null)
										<tr>
											<td>{{ $tipo_documento_aparte->descripcion }}</td>
											<td>
												@if($tipo_documento_aparte->nombre != "")
													<i class="fa fa-check" aria-hidden="true" style="color:green;"></i>
													<a href='{{ route('admin.ver_pdf_truora', ['truora_generated' => $getChecked->check_id]) }}' target="_blank">
														<i class="fa fa-file-text-o" aria-hidden="true"></i>
													</a>
												@else
													<i class="fa fa-times" aria-hidden="true" style="color:red;">
												@endif
											</td>
										</tr>
									@endif--}}
								</tbody>
							</table>
						</div>

						<div style="text-align: center;">
							<button class="btn btn-warning" onclick="window.history.back();" title="Volver">Volver</button>
							{{--<button class="btn btn-primary" id="cargarDocumentoConfi" type="button"><i class="fa fa-cloud-upload"></i>&nbsp;Cargar documento</button>--}}

						</div>
							
						<p class="error text-danger direction-botones-center">
							{!! FuncionesGlobales::getErrorData("foto",$errors) !!}
						</p>
					</div>
				</div>
			</div>
        </div>
	</div>
</div>
<script>

$(function(){
	    	$("#cargarDocumentoConfi").on("click", function(){
	      		$.ajax({
	        		url: "{{ route('admin.cargarDocumentoAdminConfidencial') }}",
	        		data: {
	        			user_id:{{ $candidato_id }},
	        			req:{{$req}}
	        		},
	        		type: "POST",
	        		beforeSend: function(){
	        		},
	        		success: function(response) {
	          			$("#modal_gr").find(".modal-content").html(response);
	          			$("#modal_gr").modal("show");
	        		}
	      		});
	    	});

});
</script>
@stop
