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
                    @foreach( $headersr as $key => $value )
                    <th class="active">
                        {{ $value }}
                    </th>
                    @endforeach
                </tr>

                @foreach( $data as $field )
                <tr>
                    <td>
                        @if(strlen($field->numero_id)>10)
                            {{(string)"\t"."PEP".$field->numero_id."\t"}}
                        @else
                            {{$field->numero_id}}
                        @endif
                    </td>
                    <td>
                        {{$field->nombres}} {{$field->primer_apellido}} {{$field->segundo_apellido}}
                    </td>
                    <td>
                        {{$field->requerimiento}}
                    </td>
                    <td>
                        {{$field->cliente}}
                    </td>
                    <td>
                        {{$field->cargo}}
                    </td>
                    <td>
                        {{$field->agencia_req}}
                    </td>
                    <td>
                        {{$field->fecha_envio}}
                    </td>
                    <td>
                        @if ($field->fecha_carga != null)
                            {!! \Carbon\Carbon::parse($field->fecha_carga)->format('Y-m-d') !!}
                        @endif
                    </td>
                    <td>
                        @if ($field->fecha_carga != null)
                            {!! \Carbon\Carbon::parse($field->fecha_carga)->toTimeString() !!}
                        @endif
                    </td>
                    <td>
                        {{$field->fecha_realizacion}}
                        {{--<ol style="padding-inline-start: 15px;">
                        @foreach($field['examenes_medicos'] as $exam_med)
                            <li>
                                {{$exam_med['fecha_realizacion']}}
                            </li>
                        @endforeach
                        </ol>--}}
                    </td>
                    <td>
                        @if($field->resultado == 1)
                            Continúa
                        @elseif($field->resultado == 2)
                            Aplazado
                        @elseif($field->resultado == 3)
                            Continúa con recomendaciones
                        @elseif($field->resultado == 4)
                            Continúa con restricciones
                        @elseif($field->resultado == 9)
                            No Continúa
                        @endif
                        {{--<ol style="padding-inline-start: 15px;">
                        @foreach($field['examenes_medicos'] as $exam_med)
                            <li>
                                @if($exam_med['resultado'] == 1)
                                    Continúa
                                @elseif($exam_med['resultado'] == 2)
                                    Aplazado
                                @elseif($exam_med['resultado'] == 3)
                                    Continúa con recomendaciones
                                @elseif($exam_med['resultado'] == 4)
                                    Continúa con restricciones
                                @elseif($exam_med['resultado'] == 9)
                                    No Continúa
                                @endif
                            </li>
                        @endforeach
                        </ol>--}}
                    </td>
                    <td>
                        {{$field->motivo_rechazo}}
                    </td>
                    <td>
                        @if($field->usuario_envio != null && $field->usuario_envio != '' && $field->usuario_envio != ' ')
                            {{ $field->usuario_envio }}
                        @else
                            {{ $field->usuario_envio_name }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div>
            @if(method_exists($data, 'appends'))
             {!! $data->appends(Request::all())->render() !!}
             @endif
        </div>
    </div>
</div>
