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
                        {{$field->numero_id}}
                    </td>
                    <td>
                        {{$field->primer_apellido}}
                    </td>
                    <td>
                        {{$field->segundo_apellido}}
                    </td>
                    <td>
                        {{$field->nombres}}
                    </td>
                    <td>
                        {{$field->telefono_movil}}
                    </td>
                    <td>
                        {{$field->email}}
                    </td>
                    <td>
                        {{$field->fecha_acepto_politica}}
                    </td>
                    <td>
                        {{$field->hora_acepto_politica}}
                    </td>
                    <td>
                        {{$field->ip_acepto_politica}}
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
