<div class="container">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Celular</th>
                    <th>Valor solicitud</th>
                    <th>Fecha solicitud</th>
                    <th>Estado solicitud</th>
                    <th>Fecha transferencia</th>
                    <th>Código transferencia</th>
                    <th>Motivo rechazo</th>
                </tr>

                <tbody>
                    @forelse($solicitudes as $count => $lista)
                        <tr>
                            <td>{{ $lista->numero_id }}</td>
                            <td>{{ $lista->nombres }}</td>
                            <td>{{ $lista->primer_apellido." ".$lista->segundo_apellido }}</td>
                            <td>{{ $lista->email }}</td>
                            <td>{{ $lista->telefono_movil }}</td>
                            <td>{{ $lista->valor_solicitud }}</td>
                            <td>{{ $lista->fecha_solicitud }}</td>
                            @if ($lista->solicitud_aprobada == 'SI')
                                <td>Aprobada</td>
                                <td>{{ $lista->fecha_transferencia . ' ' . $lista->hora_transferencia }}</td>
                                <td>{{ $lista->codigo_transferencia }}</td>
                                <td>N/A</td>
                            @elseif($lista->solicitud_aprobada == 'NO')
                                <td>Negada</td>
                                <td>N/A</td>
                                <td>N/A</td>
                                <td>{{ $lista->motivo_rechazo_desc }}</td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">No se encontraron registros.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>