<div class="container">
    <div class="row">
        @if(method_exists($data, 'total'))
        <h4>
            Total de Registros :
            <span>
                {{$data->total()}}
            </span>
        </h4>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    @foreach( $headers as $key => $value )
                    <th class="active">
                        {{ $value }}
                    </th>
                    @endforeach
                </tr>
                @if($data->count() > 0)
                    @foreach( $data as $field )
                        <tr>
                            <td>
                                {{$field->requerimiento_id}}
                            </td>
                            <td>
                                {{$field->tipo_requerimiento}}
                            </td>
                            <td>
                                {{$field->motivo_requerimiento}}
                            </td>
                            @if($sitio->agencias)
                                <td>
                                    {{$field->nombre_agencia}}
                                </td>
                            @endif
                            @if($sitio->multiple_empresa_contrato)
                                <td>
                                    {{$field->nombre_empresa}}
                                </td>
                            @endif
                            
                            <td>
                                {{$field->ciudad_req}}
                            </td>
                            <td>
                                {{$field->salario}}
                            </td>
                            <td>
                                {{$field->departamento}}
                            </td>
                            <td>
                                {{$field->pais}}
                            </td>
                            <td>
                                {{$field->cliente}}
                            </td>
                            <td>
                                {{$field->cargo_generico}}
                            </td>
                            <td>
                                {{$field->cargo_cliente}}
                            </td>
                            <td>
                                {{$field->vacantes_solicitadas}}
                            </td>
                            <td> 
                                @if($field->preperfilados==null)
                                    0
                                @else
                                     {{$field->preperfilados}}
                                @endif
                               

                            </td>
                            <td>{{$field->candidatos_aplicados}}</td>
                            <td>{{$field->candidatos_asociados}}</td>
                            <td>{{$field->cant_citados}}</td>
                            <td>{{$field->cant_enviados_pruebas}}</td>
                            <td>{{$field->cant_enviados_referenciacion}}</td>
                            <td>
                                @if($field->cant_consultas_seguridad!=null)
                                    {{$field->cant_consultas_seguridad}}
                                @else
                                    0
                                @endif
                                

                            </td>
                            <td>{{$field->cant_enviados_entrevista_virtual}}</td>
                            <td>{{$field->cant_enviados_entrevista}}</td>
                            <td>{{$field->cant_enviados_aprobar_cliente}}</td>
                            <td>{{$field->cant_enviados_examenes}}</td>
                            <td></td>
                             <td>{{$field->cant_enviados_contratacion}} </td>
                            <td>{{$field->cant_contratados}}</td>
                            <td>{{ $field->cant_enviados_excel_basico }}</td>
                            <td>{{ $field->cant_enviados_excel_intermedio }}</td>
                            <td>{{ $field->cant_enviados_ethical_values }}</td>
                            <td>{{ $field->cant_enviados_prueba_competencias }}</td>
                            <td>{{ $field->cant_enviados_prueba_digitacion }}</td>
                            <td>{{ $field->cant_enviados_prueba_bryg }}</td>
                            <td> {{$field->fecha_inicio_vacante}} </td>
                            {{--<td>
                                {{$field->cant_enviados_examenes}}
                            </td>
                            <td>
                                {{$field->cant_enviados_contratacion}}
                            </td>
                            <td>
                                {{$field->cant_contratados}}
                            </td>--}}
                            <td>
                                {{$field->fecha_tentativa}}
                            </td>
                           
                            
                                @if($field->dias_vencidos< 1 )

                                <td>
                                    0
                                </td>
                                @else
                            <td>
                                {{$field->dias_vencidos}}
                            </td>
                                @endif  
                            <td class="{{ $field->semaforo }}">
                                {{$field->estado_req}}
                            </td>

                            <td>
                                {{$field->dias_gestion}}
                            </td>
                            <td>
                                {{$field->fecha_cierre_req}}
                            </td>
                            <td>
                                {{$field->usuario_cargo_req}}
                            </td>
                            <td>
                                {{$field->usuario_gestiono_req}}
                            </td>
                            <td>
                                @if(isset($sitio))
                                     @if($sitio->asistente_contratacion==1 && $field->firma_cargo==1)
                                        {{$field->vacantes_reales_asistente}}
                                     @else
                                        {{$field->vacantes_reales}}
                                     @endif
                                 @else
                                    {{$field->vacantes_reales}}
                                 @endif
                            </td>

                            <td>
                                {{$field->ind_oport_presentacion}}%
                            </td>

                            <td>

                                @if($field->ind_calidad_presentacion > 0)
                                    {{$field->ind_calidad_presentacion}}%
                                @else
                                    0%
                                @endif
                            </td>
                            <td style="width: 100%;">

                                    <ul style="padding: 0;margin: 0;">
                                        @foreach($field->observaciones_gestion as $item)
                                            <li style="font-size: .9em;"><strong>{{$item->user->name}}({{date('Y-m-d',strtotime($item->created_at))}}): </strong>{{$item->observacion}}</li>
                                        @endforeach
                                    </ul>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </table>
        </div>
        <div>
            @if(method_exists($data, 'appends'))
                {!! $data->appends(Request::all())->render() !!}
            @endif
        </div>
    </div>
</div>
