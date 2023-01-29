<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">Nueva entrevista semiestructurada</h4>
</div>

<style>
    #campo_valor, #campo_reporte, #campo_empresa_trabajo{ display: none; }

    .vacunado_contra_covid19 input[type=number]::-webkit-inner-spin-button, 
    .vacunado_contra_covid19 input[type=number]::-webkit-outer-spin-button { 
      -webkit-appearance: none; 
      margin: 0; 
    }
</style>

<div class="modal-body">
        {{--NO ES KOMATSU--}}
        {!! Form::model(Request::all(),["id"=>"fr_entrevista_semi"]) !!}
            
            {!! Form::hidden("ref_id") !!}
            {!! Form::hidden("req_id") !!}

            <h3><p style="text-align: center;">Información del  cliente</p></h3>

            <hr>

            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-6">
                        <label for="inputEmail3" class="col-sm-2 control-label"> Cliente</label>
                        <div class="col-sm-10">
                            {!! Form::text("cliente",$proceso->nombre,["class"=>"form-control","id"=>"cliente","readonly"=>"readonly"]); !!}
                        </div>
                        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="inputEmail3" class="col-sm-4 control-label"> N° Req</label>
                        <div class="col-sm-3">
                            {!! Form::text("reff_id",$proceso->requerimiento_id,["class"=>"form-control","id"=>"reff_id","readonly"=>"readonly"]); !!}
                        </div>
                        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                    </div>

                </div>
                <br>
                <div class="row">

                    <div class="col-md-6">
                        <label for="inputEmail3" class="col-sm-2 control-label"> Cargo</label>
                        <div class="col-sm-10">
                            {!! Form::text("cargo",$proceso->descripcion,["class"=>"form-control","id"=>"cargo","readonly"=>"readonly"]); !!}
                        </div>
                        <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                    </div>

                    <div class="col-md-6">
                    </div>

                </div>
            </div>


            <h3><p style="text-align: center;">Información del  candidato</p></h3>
            
            <hr>

            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Nombres y apellidos</label>
                                <div class="col-sm-7">
                                    {!! Form::text("nombres_apellidos",$proceso->nombres." ".$proceso->primer_apellido ,["class"=>"form-control","id"=>"cliente"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Cédula</label>
                                <div class="col-sm-7">
                                    {!! Form::text("numero_id",$proceso->numero_id,["class"=>"form-control","id"=>"numero_id","readonly"=>"readonly"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>

                            
                        </div>
            
                        <br>
            
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label">N° Celular</label>
                                <div class="col-sm-7">
                                    {!! Form::text("celular",$proceso->telefono_movil,["class"=>"form-control","id"=>"cargo"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label">Edo.Civil</label>
                                <div class="col-sm-7">
                                     {!! Form::select("estado_civil",$estadoCivil,$proceso->estado_civil,["class"=>"form-control" ,"id"=>"estado_civil"]) !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                            
                            
                           
                           
                        </div>
                        
                        <br>
            
                        <div class="row">

                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Fecha de Nacimiento</label>
                                <div class="col-sm-7">
                                    {!! Form::text("fecha_nacimiento",$proceso->fecha_nacimiento,["class"=>"form-control fecha_nacimiento","readonly"=>"readonly"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>

                             <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label"> Edad</label>
                                <div class="col-sm-7">
                                    {!! Form::text("edad",tri_edad($proceso->fecha_nacimiento),["class"=>"form-control","id"=>"cargo"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                            
                           

                            
                
                        </div>
                        <div class="row">
                             <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-7">
                                    {!! Form::text("direccion",$proceso->direccion,["class"=>"form-control","id"=>"cargo"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>

                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label">Barrio</label>
                                <div class="col-sm-7">
                                    {!! Form::text("barrio",$proceso->barrio,["class"=>"form-control","id"=>"cargo"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inputEmail3" class="col-sm-3 control-label">Libreta Militar</label>
                                <div class="col-sm-7">
                                    {!! Form::text("libreta_militar",$proceso->numero_libreta,["class"=>"form-control","id"=>"cargo"]); !!}
                                </div>
                                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("aspecto_familiar",$errors) !!}</p>
                            </div>
                        </div>
                        
                        <br>

                        <h3><p style="text-align: center;">Grupo Familiar</p></h3>
                        <hr>
                            <h4>Vive con:</h4>
                            <div class="old">
                            <div class="row padre">
                                @forelse( $familiares as $familiar )
                                    <div class="item">
                                        <table class="table table-bordered tbl_info_familia">

                                            <tbody>
                                                <tr>
                                                    <td>Parentesco:</td>
                                                    <td>{!! Form::select("parentesco[]",$parentesco,$familiar->parentesco_id,["class"=>"form-control"]) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nombre:</td>
                                                    <td>{!! Form::text("nombre_vive[]",$familiar->nombres,["class"=>"form-control"]); !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Edad:</td>
                                                    <td>{!! Form::text("edad_vive[]",tri_edad($familiar->fecha_nacimiento),["class"=>"form-control"]); !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ocupación:</td>
                                                    <td>{!! Form::text("ocupacion_vive[]",$familiar->profesion_id,["class"=>"form-control"]); !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @empty
                                    <div class="item">
                                        <table class="table table-bordered tbl_info_familia">

                                            <tbody>
                                                <tr>
                                                    <td>Parentesco:</td>
                                                    <td>{!! Form::select("parentesco[]",$parentesco,null,["class"=>"form-control"]) !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Nombre:</td>
                                                    <td>{!! Form::text("nombre_vive[]",null,["class"=>"form-control"]); !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Edad:</td>
                                                    <td>{!! Form::text("edad_vive[]",null,["class"=>"form-control"]); !!}</td>
                                                </tr>
                                                <tr>
                                                    <td>Ocupación:</td>
                                                    <td>{!! Form::text("ocupacion_vive[]",null,["class"=>"form-control"]); !!}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforelse
                                </div>
                                <div class="col-md-12 form-group last-child" style="display: block;text-align:center;">
                                    <button type="button" class="btn btn-success add-item" title="Agregar">+</button>
                                </div>
                            </div>
                            <br>
                             <h4>Hijos que no vivan con el candidato:</h4>
                             <div class="old">
                            <div class="row padre">
                            <div class="item">
                             <table class="table table-bordered tbl_info_familia">

                                <tbody>

                                   
                                     <tr>
                                        <td>Nombre:</td>
                                        <td>{!! Form::text("nombre_hijo[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                     <tr>
                                        <td>Edad:</td>
                                        <td>{!! Form::text("edad_hijo[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                     <tr>
                                        <td>ocupacion:</td>
                                        <td>{!! Form::text("ocupacion[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                    <tr>
                                        <td>Con quien vive:</td>
                                        <td>{!! Form::text("con_quien[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                    <tr>
                                        <td>Cada cuanto le visita:</td>
                                        <td>{!! Form::text("cada_cuanto[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                     <tr>
                                        <td>Apoyo económico:</td>
                                        <td>{!! Form::text("apoyo_economico[]",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                      
                                    </tr>
                                    

                                </tbody>
                            </table>
                            </div>
                            </div>
                             <div class="col-md-12 form-group last-child" style="display: block;text-align:center;">
                                <button type="button" class="btn btn-success add-item" title="Agregar">+</button>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="container-fluid">
                            <div class="row">
                                <label class="col-sm-8 control-label">
                                    ¿Tiene familiares laborando actualmente dentro de la empresa usuaria? 
                                </label>
                                <div class="col-sm-4">
                                    <label class="switchBtn">
                                        {!! Form::checkbox("tiene_familiares",1,null,["class"=>"si_no", "id"=> "tiene_familiar_empresa"]) !!}
                                        <div class="slide"></div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="old tiene_familiar_empresa" style="display: none;">
                            <div class="row padre">
                                <div class="item">
                                    <table class="table table-bordered tbl_info_familia">
                                        <tbody>
                                            <tr>
                                                <td>Nombre:</td>
                                                <td>{!! Form::text("nombre_familiar[]",null,["class"=>"form-control"]); !!}</td>
                                            </tr>

                                            <tr>
                                                <td>Apellido:</td>
                                                <td>{!! Form::text("apellido_familiar[]",null,["class"=>"form-control"]); !!}</td>
                                            </tr>

                                            <tr>
                                                <td>Cargo:</td>
                                                <td>{!! Form::text("cargo_familiar[]",null,["class"=>"form-control"]); !!}</td>
                                            </tr>

                                            <tr>
                                                <td>Área:</td>
                                                <td>{!! Form::text("area_familiar[]",null,["class"=>"form-control"]); !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                             <div class="col-md-12 form-group last-child" style="display: block;text-align:center;">
                                <button type="button" class="btn btn-success add-item" title="Agregar">+</button>
                            </div>
                        </div>

                        <br>
                        <br>
                        <br>
            
                           
                                
                                    <h3><p style="text-align: center;">Información Educativa</p></h3>
                                    <hr>
                                   
                                        
                                        <br><br>
                                    <h4>Títulos</h4>
                                    <div class="old">
                                    <div class="row padre">
                                    @forelse( $estudios as $estudio )
                                        <div class="item">
                                            <table class="table table-bordered tbl_info_estudio">
                                                <tbody>

                                                    <tr>
                                                        <td>Título:</td>
                                                        <td>{!! Form::text("titulo[]",$estudio->titulo_obtenido,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Institución:</td>
                                                        <td>{!! Form::text("institucion[]",$estudio->institucion,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Año:</td>
                                                        <td>{!! Form::text("ano[]",isset($estudio->fecha_finalizacion)?date('Y', strtotime($estudio->fecha_finalizacion)):null,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Ciudad de graduación:</td>
                                                        <td>{!! Form::text("ciudad[]",$estudio->ciudad_completa_estudio,["class"=>"form-control ciudad_autocomplete"]); !!}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @empty
                                        <div class="item">
                                            <table class="table table-bordered tbl_info_estudio">
                                                <tbody>

                                                    <tr>
                                                        <td>Título:</td>
                                                        <td>{!! Form::text("titulo[]",null,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Institución:</td>
                                                        <td>{!! Form::text("institucion[]",null,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Año:</td>
                                                        <td>{!! Form::text("ano[]",null,["class"=>"form-control"]); !!}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Ciudad de graduación:</td>
                                                        <td>{!! Form::text("ciudad[]",null,["class"=>"form-control"]); !!}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    @endforelse
                                    </div>
                                     <div class="col-md-12 form-group last-child" style="display: block;text-align:center;">
                                        <button type="button" class="btn btn-success add-item" title="Agregar">+</button>
                                     </div>
                                    </div>

                                    <h4>Proyectos</h4>
                                     <table class="table table-bordered tbl_info_estudio">

                                        <tbody>

                                           
                                             <tr>
                                                <td>Proyecto 1:</td>
                                                <td>{!! Form::text("proyecto1",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                              
                                            </tr>
                                             <tr>
                                                <td>Proyecto 2:</td>
                                                <td>{!! Form::text("proyecto2",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                              
                                            </tr>
                                             <tr>
                                                <td>Proyecto 3:</td>
                                                <td>{!! Form::text("proyecto3",null,["class"=>"form-control","id"=>"cargo"]); !!}</td>

                                              
                                            </tr>
                                             

                                        </tbody>
                                    </table>
                                   
                                       <br>
                                       <br>
                                
                                        

                                   
                                
                           

                        
                    </div>
                </div>

            </div>

          
                
                <h3><p style="text-align: center;">Información Laboral</p></h3>
   
                <div class="container-fluid">
                    <div class="row">
                        
                            <label for="cargo" class="col-sm-8 control-label">¿El candidato cuenta con experiencia laboral?</label>
                                    <div class="col-sm-4">
                                        <label class="switchBtn">
                                            {!! Form::checkbox("experiencia",1,null,["class"=>"checkbox-preferencias si_no exp",'checked'=>true,"id"=>"switch"]) !!}
                                             <div class="slide"></div>
                                         </label>
                                    </div>
                      
                    </div>
                    <div class="old old_experiencias">
                    <div class="row experiencias_block padre">
                        @forelse( $experiencias as $experiencia )
                            <div class="item">
                                <table class="table table-bordered tbl_info_estudio">
                                    <tbody>
                                        <tr>
                                            <td>Empresa:</td>
                                            <td> {!! Form::text("empresa[]",$experiencia->nombre_empresa,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Cargo:</td>
                                            <td>
                                                {!! Form::text("cargo_desem[]",$experiencia->cargo_especifico,["class"=>"form-control"]) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jefe inmediato:</td>
                                            <td>{!! Form::text("jefe_inmediato[]",$experiencia->nombres_jefe,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Salario:</td>
                                            <td>{!! Form::text("salario[]",$experiencia->salario,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Beneficios:</td>
                                            <td>{!! Form::text("beneficios[]",null,["class"=>"form-control"]); !!}
                                            </td> 
                                        </tr>

                                        <tr>
                                            <td>Horario:</td>
                                            <td>{!! Form::text("horario[]",null,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Ingreso:</td>
                                            <td>{!! Form::text("ingreso[]",$experiencia->fecha_inicio,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Retiro:</td>
                                            <td>{!! Form::text("retiro[]",$experiencia->fecha_final,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Motivo de retiro:</td>
                                            <td>
                                                {!! Form::select("motivo_retiro[]",$motivoRetiro,$experiencia->motivo_retiro,["class"=>"form-control"]) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Funciones:</td>
                                            <td>{!! Form::text("funciones[]",$experiencia->funciones_logros,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @empty
                            <div class="item">
                                <table class="table table-bordered tbl_info_estudio">
                                    <tbody>
                                        <tr>
                                            <td>Empresa:</td>
                                            <td> {!! Form::text("empresa[]",null,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Cargo:</td>
                                            <td>
                                                {!! Form::text("cargo_desem[]",null,["class"=>"form-control"]) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Jefe inmediato:</td>
                                            <td>{!! Form::text("jefe_inmediato[]",null,["class"=>"form-control"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Salario:</td>
                                            <td>{!! Form::text("salario[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Beneficios:</td>
                                            <td>{!! Form::text("beneficios[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td> 
                                        </tr>

                                        <tr>
                                            <td>Horario:</td>
                                            <td>{!! Form::text("horario[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Ingreso:</td>
                                            <td>{!! Form::text("ingreso[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Retiro:</td>
                                            <td>{!! Form::text("retiro[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Motivo de retiro:</td>
                                            <td>
                                                 {!! Form::select("motivo_retiro[]",$motivoRetiro,null,["class"=>"form-control"]) !!}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>Funciones:</td>
                                            <td>{!! Form::text("funciones[]",null,["class"=>"form-control","id"=>"cargo_desem"]); !!}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforelse

                   
                </div>
                 <div class="col-md-12 form-group last-child" style="display: block;text-align:center;">
                            <button type="button" class="btn btn-success add-item" title="Agregar">+</button>
                    </div>
                </div>
                    <br>
                    <br>


                    <div class="container-fluid">
    
                            <div class="row">
                                <div class="col-md-12">
                                <label for="inputEmail3" class="col-sm-4 control-label">Disponibilidad para viajar o traslado de ciudad:</label>
                                    <div class="col-sm-12">
                                        {!! Form::textarea("disponibilidad",null,["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                    
                                    <label for="inputEmail3" class="col-sm-4 control-label">Reporte o novedades en Datacredito o Cifin:</label>
                                    <div class="col-sm-12">
                                        {!! Form::textarea("reporte",null,["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                                </div>
                    
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                    
                                    <label for="inputEmail3" class="col-sm-4 control-label">Nivel de endeudamiento:</label>
                                    <div class="col-sm-12">
                                        {!! Form::textarea("nivel_endeudamiento",null,["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                                </div>
                    
                            </div>
                             <div class="row">
                                <div class="col-md-12">
                    
                                    <label for="inputEmail3" class="col-sm-4 control-label">Multas o comparendos:</label>
                                    <div class="col-sm-12">
                                        {!! Form::textarea("multas",null,["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                                </div>
                    
                            </div>
                    </div>
                    
                        
                    

                </div>
            
            

            

            <br>

            <h3><p style="text-align: center;">Información estado de salud</p></h3>
            <hr>

            <div class="container-fluid">
    
                <div class="row">
                    <div class="col-md-12">
                    <label for="inputEmail3" class="col-sm-4 control-label"> ¿Ha tenido alguna enfermedad?</label>
                        <div class="col-sm-12">
                            {!! Form::textarea("enfermedades","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                             <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
        
                        <label for="inputEmail3" class="col-sm-4 control-label">¿Le han practicado  alguna cirugía?</label>
                        <div class="col-sm-12">
                            {!! Form::textarea("cirugias","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                             <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
        
                </div>

                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="inputEmail3" class="col-sm-4 control-label"> ¿ Posee alergias, fobias o consume algún medicamento u otros? </label>
                    <div class="col-sm-12">
                        {!! Form::textarea("alergias","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                    
                </div>

                 <div class="row">
                    <div class="col-md-12">
                    
                    <label for="inputEmail3" class="col-sm-8 control-label"> ¿ Ha tenido fiebre, tos, dolor de garganta, malestar general o
dificultad para respirar en los últimos 14 días? En caso de indicar que SI Indique cual </label>
                    <div class="col-sm-12">
                        {!! Form::textarea("covid1","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="inputEmail3" class="col-sm-8 control-label"> ¿ Ha tenido contacto estrecho con alguna persona que haya llegado
de otro país en los últimos 14 días o con con alguna persona
diagnosticada como caso sospechoso o confirmado de  COVID 19? </label>
                    <div class="col-sm-12">
                        {!! Form::textarea("covid2","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="inputEmail3" class="col-sm-8 control-label"> ¿ Vive con personas que trabajen en Servicios de Salud? </label>
                    <div class="col-sm-12">
                        {!! Form::textarea("covid3","No reporta",["class"=>"form-control","id"=>"textarea","rows"=>"1"]); !!}
                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                    
                </div>

                <div class="row">
                    <div class="col-md-12">
                    
                        <label for="inputEmail3" class="col-sm-12 control-label"> ¿Ha sido diagnosticado con COVID-19? </label>
                        <div class="col-sm-12">
                            <label class="switchBtn">
                                {!! Form::checkbox("diagnosticado_covid19",1,null,["class"=>"si_no", "id" => "diagnosticado_covid"]) !!}
                                <div class="slide"></div>
                            </label>
                        </div>
                    </div>
                    
                </div>

                <div class="row diagnosticado_covid" style="display: none;">
                    <div class="col-md-12">
                        <label for="" class="col-sm-12 control-label">¿En qué fecha fue diagnosticado?</label>
                        <div class="col-sm-4">
                            {!! Form::text("fecha_diagnosticado_covid19",null,["class"=>"form-control","id"=>"fecha_covid19","readonly"=>"readonly"]); !!}
                        </div>
                    </div>
                </div>

                <div class="row mt-1 diagnosticado_covid" style="display: none;">
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-12 control-label"> ¿Posee alguna secuela generada por COVID-19?</label>
                        <div class="col-sm-12">
                            <label class="switchBtn">
                                {!! Form::checkbox("secuela_covid19",1,null,["class"=>"si_no", "id" => "secuela_covid19"]) !!}
                                <div class="slide"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 secuela_covid19" style="display: none;">
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-8 control-label"> ¿Cuál? </label>
                        <div class="col-sm-12">
                            {!! Form::textarea("cual_secuela_covid19","",["class"=>"form-control","rows"=>"1"]); !!}
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-12 control-label">¿Se encuentra vacunado contra COVID-19?</label>
                        <div class="col-sm-12">
                            <label class="switchBtn">
                                {!! Form::checkbox("vacunado_contra_covid19",1,null,["class"=>"si_no", "id" => "vacunado_contra_covid19"]) !!}
                                <div class="slide"></div>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row mt-1 vacunado_contra_covid19" style="display: none;">
                    <div class="col-md-12">
                        <label for="inputEmail3" class="col-sm-8 control-label">¿Con cuántas dosis de vacuna contra COVID-19 cuenta? </label>
                        <div class="col-sm-12">
                            {!! Form::number("cuantas_dosis_vacuna_covid19",null,["class"=>"form-control", "id" => "cantidad_dosis_vacuna_covid19"]); !!}
                        </div>
                    </div>
                </div>

                <div class="row mt-1 vacunado_contra_covid19" style="display: none;">
                    <div class="col-md-12 campos_fecha_dosis">
                        <label for="inputEmail3" class="col-sm-12 control-label">¿En qué fechas se aplicó cada dosis? </label>
                    </div>
                </div>

                
                
                {{-- <div class="row">
                    <div class="col-md-12">
                    <h3>Información Sociocultural</h3>
                    <br>
                        <div class="col-md-6">

                               <div class="form-group">
                                    <label for="trabajo-empresa-temporal" class="col-md-6 control-label">¿Realiza alguna actividad o pertenece a algún grupo social , deportivo o cultural?</label>
                                    <div class="col-md-6">
                                        {!! Form::checkbox("grupo_social",1,0,["class"=>"checkbox-preferencias"]) !!}

                                    </div>
                                </div>
                            
                        </div>

                    <div class="col-md-6">       
                    <label for="inputEmail3" class="col-sm-2 control-label"> ¿Cúal?</label>
                    <div class="col-sm-8">
                        {!! Form::text("descrip_social",null,["class"=>"form-control"]); !!}
                         <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("estado_salud",$errors) !!}</p></div>
                    </div>
                    </div>
                    </div>
                --}}
            </div>

            <h3 style="text-align:center;" >Evaluación </h3>
            
            <table class="table table-bordered tbl_info">
                <thead>
                    <tr>
                        <th>Nombre Evaluación</th>
                        <th style="width:40%; text-align: center;">Descripción</th>
                        <th>Sin Evaluar</th>
                        <th style="width:30px">Inferior requerido</th>
                        <th style="width:10px">Acorde requerido</th>
                        <th style="width:10px">Superior requerido</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>PRESENTACIÓN PERSONAL </td>
                        <td width="50">Vestimenta, aseo y apariencia personal</td>
                        <td width="10">{!!  Form::radio("competencia[1]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[1]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[1]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[1]",4) !!}</td>
                    </tr>
                    
                    <tr>
                      <td>COMPORTAMIENTO VERBAL</td>
                      <td width="20">Vocabulario empleado, fluidéz verbal, hilación y coherencias en las ideas.</td>
                      <td width="10">{!!  Form::radio("competencia[2]",1) !!}</td>
                      <td>{!!  Form::radio("competencia[2]",2) !!}</td>
                      <td>{!!  Form::radio("competencia[2]",3,true) !!}</td>
                      <td>{!!  Form::radio("competencia[2]",4) !!}</td>
                    </tr>
                    <tr>
                        <td>COMPORTAMIENTO NO VERBAL</td>
                         <td>Contacto visual, gestos, movimientos de las manos y disposición corporal.</td>
                         <td width="10">{!!  Form::radio("competencia[3]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[3]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[3]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[3]",4) !!}</td>
                    </tr>
                    <tr>
                        <tr>
                            <td></td>
                        </tr>
                        <td>AUTOESTIMA</td>
                         <td>Auto-estima, auto concepto, auto eficacia y auto imagen.</td>
                         <td width="10">{!!  Form::radio("competencia[4]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[4]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[4]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[4]",4) !!}</td>
                    </tr>
                    <tr>
                        <td>PROYECCIÓN</td>
                         <td>Establecimiento de sus metas personales, laborales, académicas, comportamientos proactivos.</td>
                         <td width="10">{!!  Form::radio("competencia[5]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[5]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[5]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[5]",4) !!}</td>
                    </tr>
                    <tr>
                        <td>HABILIDAD DE AFRONTAMIENTO</td>
                         <td>Capacidad para adaptarse a nuevas situaciones, empleo de fortalezas, académicas,  comportamientos proactivos para resolución de conflictos y facilidad en la toma de decisiones.</td>
                         <td width="10">{!!  Form::radio("competencia[6]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[6]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[6]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[6]",4) !!}</td>
                    </tr>
                    <tr>
                        <td>HABILIDADES SOCIALES</td>
                         <td>Empatía, amabilidad, iniciativa y facilidad  en la interacción.</td>
                         <td width="10">{!!  Form::radio("competencia[7]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[7]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[7]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[7]",4) !!}</td>
                    </tr>
                    <tr>
                        <td>MOTIVACIÓN</td>
                         <td>Interés por el cargo, interés en la organización  y dinamismo.</td>
                         <td width="10">{!!  Form::radio("competencia[8]",1) !!}</td>
                        <td>{!!  Form::radio("competencia[8]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[8]",3,true) !!}</td>
                        <td>{!!  Form::radio("competencia[8]",4) !!}</td>
                    </tr>
                    @foreach($competencias as $competencia )
                    <tr>
                        <td>{{$competencia->nombre}}</td>
                        <td width="10">{!!  Form::radio("competencia[".$competencia->competencia_entrevista_id."]",1) !!}</td>
                        <td width="10">{!!  Form::radio("competencia[".$competencia->competencia_entrevista_id."]",2) !!}</td>
                        <td>{!!  Form::radio("competencia[".$competencia->competencia_entrevista_id."]",3) !!}</td>
                        <td>{!!  Form::radio("competencia[".$competencia->competencia_entrevista_id."]",4) !!}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

            

            <br><br>

            <h3><p style="text-align: center;">Especificaciones para el cargo</p></h3>
            <hr>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="fortalezas" class="col-sm-4 control-label"> Fortalezas <span></span></label>
                    <div class="col-sm-12">
                        {!! Form::textarea("fortalezas",null,[
                        "class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"fortalezas",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p></div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="opor_mejora" class="col-sm-12 control-label"> Oportunidades de mejora<span></span></label>
                    <div class="col-sm-12">
                        {!! Form::textarea("opor_mejora",null,
                        ["class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"opor_mejora",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p></div>
                </div>
                 <div class="row" style="display: none;">
                    <div class="col-md-12">
                    
                    <label for="proyectos" class="col-sm-12 control-label"> Proyectos y/o expectativas <span></span></label>
                    <div class="col-sm-12">
                        {!! Form::textarea("proyectos",null,
                        [
                        "class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"proyectos",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p></div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                    
                    <label for="valores" class="col-sm-12 control-label"> Valores y/o compromisos <span></span></label>
                    <div class="col-sm-12">
                        {!! Form::textarea("valores",null,[
                        "class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"valores",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p></div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                    
                    <label for="candidato_idoneo" class="col-sm-12 control-label"> ¿Por qué el candidato es idóneo para el cargo? <span></span></label>
                    <div class="col-sm-12">
                     {!! Form::textarea("candidato_idoneo",null,
                        ["class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"candidato_idoneo",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p>
                 </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="gastos_mensuales" class="col-sm-12 control-label"> Gastos mensuales: (Valor y en que los invierte) <span></span></label>
                    <div class="col-sm-12">
                     {!! Form::textarea("gastos_mensuales",null,
                     ["class"=>"form-control",
                      "maxlength" => "2000",
                     "placeholder" => "Máximo 2000 caracteres",
                     "id"=>"gastos_mensuales",
                     "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p>
                 </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                    
                    <label for="ingresos_adicionales" class="col-sm-12 control-label"> Ingresos adicionales: <span></span></label>
                    <div class="col-sm-12">
                     {!! Form::textarea("ingresos_adicionales",null,[
                     "class"=>"form-control",
                      "maxlength" => "2000",
                     "placeholder" => "Máximo 2000 caracteres",
                     "id"=>"ingresos_adicionales",
                     "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p>
                 </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                    
                    <label for="pasatiempos" class="col-sm-12 control-label"> Pasatiempos: <span></span></label>
                    <div class="col-sm-12">
                     {!! Form::textarea("pasatiempos",null,[
                     "class"=>"form-control",
                      "maxlength" => "2000",
                     "placeholder" => "Máximo 2000 caracteres",
                     "id"=>"pasatiempos",
                     "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p>
                 </div>
                </div>
                <div class="row">
                 
                </div>
                 <div class="row">
                    <div class="col-md-12">
                   <h3><p style="text-align: center;">Informe y concepto de Aptitud</p></h3>
                    <hr>
                   
                    <div class="col-sm-12">
                        {!! Form::textarea("concepto_entre",null,[
                        "class"=>"form-control",
                        "maxlength" => "2000",
                        "placeholder" => "Máximo 2000 caracteres",
                        "id"=>"concepto_entre",
                        "rows"=>"3"]); !!}
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("especificaciones_cargo",$errors) !!}</p>
                </div>
            </div>

            <br>

            <div class="clearfix"></div>

            <div class="col-md-12">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="trabajo-empresa-temporal" class="col-md-2 control-label">Apto:</label>
                        <div class="col-md-7">
                         <label class="switchBtn">
                          {!! Form::checkbox("apto",1,1,["class"=>"checkbox-preferencias",'checked'=>true,"id"=>"switch"]) !!}
                          <div class="slide"></div>
                         </label>
                        </div>
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("apto",$errors) !!}</p>
                </div>

                <div class="col-md-4">
                   <div class="form-group">
                        <label for="trabajo-empresa-temporal" class="col-md-4 control-label">Aplazado:</label>
                        <div class="col-md-7">
                         <label class="switchBtn">
                          {!! Form::checkbox("aplazado",1,null,["class"=>"checkbox-preferencias si_no",'checked'=>true,"id"=>"switch"]) !!}
                          <div class="slide"></div>
                         </label>

                        </div>
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("apto",$errors) !!}</p>
                </div>
               
                <div class="col-md-4">
                    <div class="form-group">
                     <label for="trabajo-empresa-temporal" class="col-md-4 control-label">Pendiente:</label>
                      <div class="col-md-7">
                        <label class="switchBtn">
                         {!! Form::checkbox("pendiente",1,null,["class"=>"checkbox-preferencias si_no",'checked'=>true,"id"=>"switch"]) !!}
                          <div class="slide"></div>
                        </label>
                      </div>
                    </div>
                    <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("apto",$errors) !!}</p>
                </div>
         
            </div>

            <div class="clearfix"></div>

            <div class="col-sm-6 col-sm-offset-6" style="background-color: #fdf06a; padding: .5em;">
                <div class="form-group">
                    <label for="trabajo-empresa-temporal" class="col-md-5 control-label">Entrevista Definitiva:</label>

                    <div class="col-md-7">
                        <label class="switchBtn">
                        
                            {!! Form::checkbox("definitiva",1,1,["class"=>"checkbox-preferencias si_no","id"=>"switch"]) !!}

                            <div class="slide"></div>
                        </label>

                    </div>
                </div>
                <p class="error text-danger direction-botones-center">{!! FuncionesGlobales::getErrorData("apto",$errors) !!}</p>
            </div>
    
        {!! Form::close() !!}
        {{--FIN NO ES KOMATSU--}}
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    <button type="button" class="btn btn-success" id="guardar_entrevista_semi" >Guardar</button>
</div>

<script>
    $(function () {

        $('#ciudad_autocomplete').autocomplete({
            serviceUrl: '{{ route("autocomplete_cuidades_all") }}',
            autoSelectFirst: true,
            onSelect: function (suggestion) {
                
            }
        });

        $(".exp").on("change", function () {
            $(".old_experiencias").toggle('slow');
        });

        $(document).on('click', '.add-item', function (e) {
                fila_person = $(this).parents('.old').find('.item').eq(0).clone();
                fila_person.find('input').val('');
                fila_person.find('select').val('');

                //fila_person.find('div.last-child').append('<button type="button" class="btn btn-danger rem-person">-</button>');
                fila_person.append('<div class="col-md-12 form-group last-child" style="display: block;text-align:center;"><button type="button" class="btn btn-danger rem-item">-</button></div>');

                $(this).parents('.old').find('.padre').append(fila_person);
            });

         $(document).on('click', '.rem-item', function (e) {
                $(this).parents('.item').remove();

            });
       // $('.checkbox-preferencias').bootstrapSwitch();

        @if (route('home') == "https://demo.t3rsc.co" || route('home') == "http://demo.t3rsc.co" || route('home') == "http://localhost:8000" || route('home') == "https://nases.t3rsc.co" || route('home') == "http://nases.t3rsc.co")

            $('input[type=radio][name=pregunta_validacion_8]').change(function() {
                if (this.value == 1) {
                    $('#campo_valor').show('slow');
                }
                else if (this.value == 0) {
                    $('#campo_valor').hide('slow');
                    document.getElementById('campo_valor').value = '';
                }
            });

            $('input[type=radio][name=pregunta_validacion_9]').change(function() {
                if (this.value == 1) {
                    $('#campo_reporte').show('slow');
                }
                else if (this.value == 0) {
                    $('#campo_reporte').hide('slow');
                    document.getElementById('campo_reporte').value = '';
                }
            });

            $('input[type=radio][name=pregunta_validacion_10]').change(function() {
                if (this.value == 1) {
                    $('#campo_empresa_trabajo').show('slow');
                }
                else if (this.value == 0) {
                    $('#campo_empresa_trabajo').hide('slow');
                    document.getElementById('campo_empresa_trabajo').value = '';
                }
            });

            $('#ciudad_nacimiento_txt').autocomplete({
                serviceUrl: '{{ route("autocomplete_cuidades") }}',
                autoSelectFirst: true,
                onSelect: function (suggestion) {
                    $("#pais_nacimiento").val(suggestion.cod_pais);
                    $("#departamento_nacimiento").val(suggestion.cod_departamento);
                    $("#ciudad_nacimiento").val(suggestion.cod_ciudad);
                }
            });

            $('#ciudad_residencia_txt').autocomplete({
                serviceUrl: '{{ route("autocomplete_cuidades") }}',
                autoSelectFirst: true,
                onSelect: function (suggestion) {
                    $("#pais_residencia").val(suggestion.cod_pais);
                    $("#departamento_residencia").val(suggestion.cod_departamento);
                    $("#ciudad_residencia").val(suggestion.cod_ciudad);
                }
            });

            $('#ciudad_nacimiento_familiar').autocomplete({
                serviceUrl: '{{ route("autocomplete_cuidades") }}',
                autoSelectFirst: true,
                onSelect: function (suggestion) {
                    $("#pais_id_familia_nac").val(suggestion.cod_pais);
                    $("#ciudad_id_familia_nac").val(suggestion.cod_departamento);
                    $("#departamento_id_familia_nac").val(suggestion.cod_ciudad);
                }
            });

            $('#ciudad_experiencia_txt').autocomplete({
                serviceUrl: '{{ route("autocomplete_cuidades") }}',
                autoSelectFirst: true,
                onSelect: function (suggestion) {
                    $("#pais_experiencia").val(suggestion.cod_pais);
                    $("#ciudad_experiencia").val(suggestion.cod_departamento);
                    $("#departamento_experiencia").val(suggestion.cod_ciudad);
                }
            });

            $(document).on('click', '.add-person', function (e) {
                fila_person = $(this).parents('#nuevo_familiar').find('.grupos_fams').eq(0).clone();
                fila_person.find('input').val('');
                fila_person.find('.boton_aqui').append('<button type="button" class="btn btn-danger pull-right rem-person" title="Remover grupo">-</button>');

                $('#nuevo_familiar').append(fila_person);
            });

            $(document).on('click', '.rem-person', function (e) {
                $(this).parents('.grupos_fams').remove();
            });

            $(document).on('click', '.add-expe', function (e) {
                fila_person = $(this).parents('#nueva_experiencia').find('.grupos_expe').eq(0).clone();
                fila_person.find('input').val('');
                fila_person.find('.boton_aqui_exp').append('<button type="button" class="btn btn-danger pull-right rem-expe" title="Remover grupo">-</button>');

                $('#nueva_experiencia').append(fila_person);
            });

            $(document).on('click', '.rem-expe', function (e) {
                $(this).parents('.grupos_expe').remove();
            });
            
        @endif

    });

    //Ocultar textarea evaluacion competencias
    $(function(){

        var confDatepicker = {
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
            yearRange: "1930:2050",
            maxDate:new Date()
        };

        $("#fecha_covid19, .fecha_nacimiento").datepicker(confDatepicker);

        $(document).on('change', '#diagnosticado_covid', function() {

                if( $(this).is(':checked') ){
                  $(".diagnosticado_covid").fadeIn()

                    if( $('#secuela_covid19').is(':checked') ){
                        $(".secuela_covid19").fadeIn()
                    }
                }else{
                  $(".diagnosticado_covid").fadeOut()
                  $(".secuela_covid19").fadeOut()
                }
        })

        $(document).on('change', '#secuela_covid19', function() {

            if( $(this).is(':checked') ){
                $(".secuela_covid19").fadeIn()
            }else{
                $(".secuela_covid19").fadeOut()
            }
        })

        $(document).on('change', '#vacunado_contra_covid19', function() {

            if( $(this).is(':checked') ){
                $(".vacunado_contra_covid19").fadeIn()
            }else{
                $(".vacunado_contra_covid19").fadeOut()
            }
        })

        $(document).on('keyup' , '#cantidad_dosis_vacuna_covid19', function() {

            let cantidad = $(this).val()

            $('.campos_fecha_dosis').find('.col-sm-4').remove()

            for (let i = 1; i <= cantidad; i++) {
                
                $('.campos_fecha_dosis').append(`
                    <div class="col-sm-4 mt-1">
                    <input type="text" name="fecha_vacuna_covid19[]" class="form-control" id="fecha_vacuna_covid19_${i}" readonly="readonly">
                    </div>   
                `)

                $("#fecha_vacuna_covid19_"+i).datepicker(confDatepicker);
            }
        })

        $(document).on('change', '#tiene_familiar_empresa', function() {

            if( $(this).is(':checked') ){
                $(".tiene_familiar_empresa").fadeIn()
            }else{
                $(".tiene_familiar_empresa").fadeOut()
            }
        })

        $('.ocultar').hide();

        $('.fantasma').change(function(){
            if(!$(this).prop('checked')){
                $('.ocultar').hide();
            }else{
                $('.ocultar').show();
            }
        });

        $(document).on('keyup', "[maxlength]", function (e) {
          var este = $(this),
          maxlength = este.attr('maxlength'),
          maxlengthint = parseInt(maxlength),
          textoActual = este.val(),
          currentCharacters = este.val().length;
          remainingCharacters = maxlengthint - currentCharacters,
          espan = este.parent().prev('label').find('span');

          // Detectamos si es IE9 y si hemos llegado al final, convertir el -1 en 0 - bug ie9 porq. no coge directamente el atributo 'maxlength' de HTML5
          if (document.addEventListener && !window.requestAnimationFrame) {
            if (remainingCharacters <= -1) {
              remainingCharacters = 0;            
            }
          }

          espan.html('('+remainingCharacters+' caracteres restantes.)');

          //console.log(remainingCharacters);

          if (!!maxlength) {
            var texto = este.val(); 
            if (texto.length >= maxlength) {
              este.addClass("borderojo");
              este.val(text.substring(0, maxlength));
              e.preventDefault();
            } else if (texto.length < maxlength) {
              este.addClass("bordegris");
            }
          }
        });
    });
    
</script>