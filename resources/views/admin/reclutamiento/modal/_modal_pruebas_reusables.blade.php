<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title">
        Confirmación de envío de pruebas al candidato {{$datos_candidato->nombre_completo}}
    </h4>
    {{--
    <h4>
        <strong>
            Confirmación de envío de pruebas
        </strong>
    </h4>
    <h5>
        <strong>Candidato</strong> {{$datos_candidato->nombre_completo}} | <strong>{{$candidato->cod_tipo_identificacion}}</strong> {{$candidato->numero_id }}
    </h5>
    --}}
</div>

<div class="modal-body">
    @if(count($pruebasEnviadas) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-success text-left" style="border-radius: 12px; border: 3px solid #d6e9c6;">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h5 class="mb-2 tri-fw-700">Prueba(s) enviada(s) exitosamente:</h5>
                        </div>
                        <div class="col-md-12">
                            <ul>
                                @foreach($pruebasEnviadas as $prueba)
                                    <li>{{ $prueba }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(count($pruebasReusar) > 0)
        <form id="form_procesos_reusables">
            <input type="hidden" name="user_id" value="{{ $datos_candidato->user_id }}">
            <input type="hidden" name="req_id" value="{{ $datos_candidato->req_id }}">
            <input type="hidden" name="cand_req_id" value="{{ $datos_candidato->cand_req_id }}">

            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-2 tri-fw-700">Pruebas que el candidato ha respondido y pueden ser reusadas:</h5>
                </div>

                @if (in_array('competencias', $pruebasReusar))
                    <div class="col-md-12">
                        <div class="panel panel-default text-left">
                            <div class="panel-body">
                                <div class="col-md-12 mb-1">
                                    <h4>Prueba Competencias</h4>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <a href="{{ route('admin.prueba_competencias_informe_preview', ['prueba_id' => $reusarCompetencia['id'], 'req_id' => $datos_candidato->req_id, 'user_id' => $datos_candidato->user_id]) }}" target="_blank">Ver informe {{$reusarCompetencia['fecha']}}<i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>

                                <div class="col-md-12 form-group" style="display: flex; gap: 1rem;">
                                    <div class="tri-radio">
                                        <label>
                                            <input type="radio" name="competencias" value="{{ $reusarCompetencia['id'] }}" required> <span>Reusar prueba resuelta el {{$reusarCompetencia['fecha']}}</span>
                                        </label>
                                    </div>

                                    <div class="tri-radio">
                                        <label>
                                            <input type="radio" name="competencias" value="nueva" required> <span>Nueva prueba</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (in_array('bryg', $pruebasReusar))
                    <div class="col-md-12">
                        <div class="panel panel-default text-left">
                            <div class="panel-body">
                                <div class="col-md-12 mb-1">
                                    <h4>Prueba BRYG-A</h4>
                                </div>

                                <div class="col-md-12 mb-2">
                                    <a href="{{ route('cv.prueba_bryg_informe_preview', ['bryg_id' => $reusarBryg['id'], 'req_id' => $datos_candidato->req_id, 'user_id' => $datos_candidato->user_id]) }}" target="_blank">Ver informe {{$reusarBryg['fecha']}}<i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>

                                <div class="col-md-12 form-group" style="display: flex; gap: 1rem;">
                                    <div class="tri-radio">
                                        <label>
                                            <input type="radio" name="bryg" value="{{ $reusarBryg['id'] }}" required> <span>Reusar prueba resuelta el {{$reusarBryg['fecha']}}</span>
                                        </label>
                                    </div>

                                    <div class="tri-radio">
                                        <label>
                                            <input type="radio" name="bryg" value="nueva" required> <span>Nueva prueba</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if (in_array('valores', $pruebasReusar))
                    <div class="col-md-12">
                        <div class="panel panel-default text-left">
                            <div class="panel-body">
                                <div class="col-md-12 mb-1">
                                    <h4>Prueba Ethical Values</h4>
                                </div>

                                <div class="col-md-12 mb-2">
                                    @foreach ($reusarValores as $reusarV)
                                        @if ($reusarV['prueba'] == 'general')
                                            <a href="{{ route('admin.preliminar_prueba_valores', ['tipo' => 'general', 'respuesta_id' => $reusarV['id'], 'req_id' => $datos_candidato->req_id]) }}" target="_blank">Ver informe {{$reusarV['fecha']}}<i class="fa fa-eye" aria-hidden="true"></i></a>
                                        @endif
                                        @if ($reusarV['prueba'] == 'requerimiento')
                                            <a href="{{ route('admin.preliminar_prueba_valores', ['tipo' => 'requerimiento', 'respuesta_id' => $reusarV['id'], 'req_id' => $datos_candidato->req_id]) }}" target="_blank">Ver informe {{$reusarV['fecha']}}<i class="fa fa-eye" aria-hidden="true"></i></a>
                                        @endif
                                    @endforeach
                                </div>

                                <div class="col-md-12 form-group" style="display: flex; gap: 1rem;">
                                    @foreach ($reusarValores as $reusarV)
                                        @if ($reusarV['prueba'] == 'general')
                                            <div class="tri-radio">
                                                <label>
                                                    <input type="radio" name="valores" value="{{ $reusarV['id'] }}-general" required> <span>Reusar prueba resuelta el {{$reusarV['fecha']}}</span>
                                                </label>
                                            </div>
                                        @endif

                                        @if ($reusarV['prueba'] == 'requerimiento')
                                            <div class="tri-radio">
                                                <label>
                                                    <input type="radio" name="valores" value="{{ $reusarV['id'] }}-especifico" required> <span>Reusar prueba resuelta el  {{$reusarV['fecha']}}</span>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach

                                    <div class="tri-radio">
                                        <label>
                                            <input type="radio" name="valores" value="0" required> <span>Nueva prueba</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </form>
    @endif

    <div class="clearfix"></div>
</div>

<div class="modal-footer">    
    <button type="button" class="btn btn-default | tri-px-2 tri-br-2 tri-border--none tri-transition-200" data-dismiss="modal">Cerrar</button>

    @if(count($pruebasReusar) > 0)
        <button type="button" class="btn btn-success | tri-px-2 tri-br-2 tri-border--none tri-transition-200 tri-green" id="confirmar_pruebas_reusar">Confirmar</button>
    @endif
</div>
