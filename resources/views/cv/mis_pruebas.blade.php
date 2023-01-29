@extends("cv.layouts.master")

<?php
    $porcentaje = FuncionesGlobales::porcentaje_hv(Sentinel::getUser()->id);
?>

@section("menu_candidato")
    @include("cv.includes.menu_candidato")
@endsection

@section('content')
    <style>
        .mt{ margin-top: 4rem; }

        .mb-1{ margin-bottom: 1rem; }
        .mb-2{ margin-bottom: 2rem; }
        .mb-3{ margin-bottom: 3rem; }
        .mb-4{ margin-bottom: 4rem; }

        .mt-1{ margin-top: 1rem; }
        .mt-2{ margin-top: 2rem; }
        .mt-3{ margin-top: 3rem; }
        .mt-4{ margin-top: 4rem; }

        .grid-container{ overflow-x: hidden !important; }

        .modal-dialog { width: 800px; margin: 30px auto; }

        .text-align--initial { text-align: initial; }
        .img-width--initial { max-width: initial; }

        .pd-1{ padding-bottom: 1rem; }
        .pd-2{ padding-bottom: 2rem; }

        .fa-2 {
            font-size: 2em;
        }
    </style>

    <div class="col-right-item-container">
        <div class="container-fluid">
            <div class="col-md-12 all-categorie-list-title bt_heading_3">
                <h1>Mis Pruebas</h1>

                <div class="blind line_1"></div>
                <div class="flipInX-1 blind icon"><span class="icon"><i class="fa fa-stop"></i>&nbsp;&nbsp;<i class="fa fa-stop"></i></span></div>
                <div class="blind line_2"></div>
            </div>

            <div class="row">
                <h3 class="header-section-form"></h3>

                <div class="col-md-12">
                    <p class="text-primary set-general-font-bold">
                        Aquí podrá encontrar las pruebas que puede realizar en la plataforma
                    </p>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="panel {{ empty($prueba_pskills) ? 'panel-default' : 'panel-success' }} text-left">
                        <div class="panel-heading">
                            <h3 class="panel-title">Prueba Personal Skills</h3>
                        </div>

                        <div class="panel-body">
                            @if (empty($prueba_pskills))
                                <p>Si deseas ingresar a realizar la prueba Personal Skills, debes dar clic en el botón <b>comenzar prueba</b></p>

                                <div class="text-right">
                                    <a href="{{ route('cv.competencias_inicio_sola') }}" class="btn btn-success">Comenzar prueba <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            @else
                                <p>
                                    Prueba completada. Ya has realizado esta prueba.
                                    <span class="pull-right">
                                        <i class="fa fa-check-circle-o fa-2x text-success"></i>
                                    </span>
                                </p>

                                <div class="text-right">
                                    {{-- <a href="{{ route('admin.prueba_competencias_informe_sola', ['prueba_id' => $prueba_pskills->id]) }}" target="_blank" class="btn btn-success">Ver informe <i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="panel {{ empty($prueba_bryg) ? 'panel-default' : 'panel-success' }} text-left">
                        <div class="panel-heading">
                            <h3 class="panel-title">Prueba BRYG-A</h3>
                        </div>

                        <div class="panel-body">
                            @if (empty($prueba_bryg))
                                <p>Si deseas ingresar a realizar la prueba BRYG-A, debes dar clic en el botón <b>comenzar prueba</b></p>

                                <div class="text-right">
                                    <a href="{{ route('cv.prueba_inicio_sola') }}" class="btn btn-success">Comenzar prueba <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            @else
                                <p>
                                    Prueba completada. Ya has realizado esta prueba.
                                    <span class="pull-right">
                                        <i class="fa fa-check-circle-o fa-2x text-success"></i>
                                    </span>
                                </p>

                                <div class="text-right">
                                    {{-- <a href="{{ route('cv.prueba_bryg_informe_sola', ['bryg_id' => $prueba_bryg->id]) }}" target="_blank" class="btn btn-success">Ver informe <i class="fa fa-eye" aria-hidden="true"></i></a> --}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="panel {{ empty($prueba_valores) ? 'panel-default' : 'panel-success' }} text-left">
                        <div class="panel-heading">
                            <h3 class="panel-title">Prueba Ethical Values</h3>
                        </div>

                        <div class="panel-body">
                            @if (empty($prueba_valores))
                                <p>Si deseas ingresar a realizar la prueba Ethical Values, debes dar clic en el botón <b>comenzar prueba</b></p>

                                <div class="text-right">
                                    <a href="{{ route('cv.prueba_valores_general') }}" class="btn btn-success">Comenzar prueba <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            @else
                                <p>
                                    Prueba completada. Ya has realizado esta prueba.
                                    <span class="pull-right">
                                        <i class="fa fa-check-circle-o fa-2x text-success"></i>
                                    </span>
                                </p>

                                <div class="text-right">
                                    {{--<a href="{{ route('admin.pdf_prueba_valores_general', ['id_respuesta_user' => $prueba_valores->id]) }}" target="_blank" class="btn btn-success">Ver informe <i class="fa fa-eye" aria-hidden="true"></i></a>--}}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="panel {{ empty($excel_basico) ? 'panel-default' : 'panel-success' }} text-left">
                        <div class="panel-heading">
                            <h3 class="panel-title">Prueba Excel Básico</h3>
                        </div>

                        <div class="panel-body">
                            @if (empty($excel_basico))
                                <p>Si deseas ingresar a realizar la prueba Excel Básico, debes dar clic en el botón <b>comenzar prueba</b></p>

                                <div class="text-right">
                                    <a href="{{ route('cv.prueba_excel_solo_basico') }}" class="btn btn-success">Comenzar prueba <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            @else
                                <p>Prueba completada. Ya has realizado esta prueba, pero puedes visualizar el informe generado.</p>

                                <div class="text-right">
                                    <a href="{{ route('pdf_prueba_excel_solo', ['id_respuesta_user' => $excel_basico->id]) }}" target="_blank" class="btn btn-success">Ver informe <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="panel {{ empty($excel_intermedio) ? 'panel-default' : 'panel-success' }} text-left">
                        <div class="panel-heading">
                            <h3 class="panel-title">Prueba Excel Intermedio</h3>
                        </div>

                        <div class="panel-body">
                            @if (empty($excel_intermedio))
                                <p>Si deseas ingresar a realizar la prueba Excel Intermedio, debes dar clic en el botón <b>comenzar prueba</b></p>

                                <div class="text-right">
                                    <a href="{{ route('cv.prueba_excel_solo_intermedio') }}" class="btn btn-success">Comenzar prueba <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                            @else
                                <p>Prueba completada. Ya has realizado esta prueba, pero puedes visualizar el informe generado.</p>

                                <div class="text-right">
                                    <a href="{{ route('pdf_prueba_excel_solo', ['id_respuesta_user' => $excel_intermedio->id]) }}" target="_blank" class="btn btn-success">Ver informe <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="reservarModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content"></div>
        </div>
    </div>
@stop