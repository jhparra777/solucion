@extends("admin.layout.master")
@section("contenedor")
<div class="col-md-8 col-md-offset-2">
    {!! Form::open(["id"=>"fr_sercon","route"=>"admin.sercon.guardar","method"=>"POST"]) !!}
    <h3>Nuevo SERCON</h3>
    
    @include("admin.sercon.include.form")
    
    {!! FuncionesGlobales::valida_boton_req("admin.sercon.guardar","Guardar","submit","btn btn-success") !!}
    <a href="#" class="btn btn-warning" onclick="window.history.back()">Volver Listado</a>
    {!! Form::close() !!}
</div>
@stop