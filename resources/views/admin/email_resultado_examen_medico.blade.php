<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

	<h2>Apreciado (a) cliente {{$proceso->cliente}}</h2>

	<h3>Reciba un cordial saludo del área de Seguridad y Salud de Soluciones Inmediatas </h3>

	<p>A continuación encontrarás las recomendaciones y/o restricciones emitidas en el certificado medico de la evaluación médica ocupacional de ingreso realizada al candidato <strong>{{strtoupper($candidato->nombres)}} {{strtoupper($candidato->primer_apellido)}} {{strtoupper($candidato->segundo_apellido)}}</strong> con ID <strong>{{$candidato->numero_id}}</strong> para el cargo <strong>{{strtoupper($proceso->cargo)}}</strong>.</p>

	<br>

	<h4>Recomendaciones y/o restricciones</h4>

	<p>{{$observacion}}</p>

	<br>

	<h3>Entra en Seguimiento por SST SOLUCIONES INMEDIATAS</h3>

	<br>
	@if($seguimiento)
		<strong>SI</strong>
	@else
		<strong>NO</strong>
	@endif





</body>
</html>