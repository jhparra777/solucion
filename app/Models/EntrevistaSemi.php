<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntrevistaSemi extends Model
{
    protected $table    = 'entrevista_semi';
    protected $fillable = [
        "id",
        "candidato_id",
        "otros_trabajos",
        "activo",
        "aplazado",
        "pendiente",
        "user_gestion_id",
        "apto",
        "enfermedades",
        "cirugias",
        "alergias",
        "grupo_social",
        "descrip_social",
        "fortalezas",
        "opor_mejora",
        "proyectos",
        "valores",
        "candidato_idoneo",
        "gastos_mensuales",
        "ingresos_adicionales",
        "pasatiempos",
        "disponibilidad",
        "nivel_endeudamiento",
        "multas",
        "covid1",
        "covid2",
        "covid3",
        "diagnosticado_covid19",
        "fecha_diagnosticado_covid19",
        "secuela_covid19",
        "cual_secuela_covid19",
        "vacunado_contra_covid19",
        "cuantas_dosis_vacuna_covid19",
        "fechas_vacunas_covid19",
        "tiene_familiares",
        "familiares",
         "proyecto1",
        "proyecto2",
        "proyecto3",
        "reporte",
        "nombres_apellidos",
        "cedula",
        "celular",
        "estado_civil",
        "fecha_nacimiento",
        "edad",
        "direccion",
        "barrio",
        "concepto_entre",
        "familiares_fanalca",
        "libreta_militar",
        "req_id",
        "conflicto",
        "conflicto_entrevistador",
        "info_general",
        "idioma_1",
        "nivel_1",
        "idioma_2",
        "nivel_2",
        "expectativas",
        "motivacion",
        "justificacion",
        "comentarios_entrevistado",
        "comentarios_entrevistador",
        "tentativo",
        "herramientas",
        "otras_herramientas",
        "continua",
        "fecha_diligenciamiento",
        "observacion_familiar",
        "observacion_libreta",
        "observacion_hijos",
        "observacion_estudios",
        "observacion_experiencia",
        "observacion_experiencia_1",
        "observacion_experiencia_2",
        "observacion_experiencia_3",
        "pregunta_validacion_1",
        "pregunta_validacion_2",
        "pregunta_validacion_3",
        "pregunta_validacion_4",
        "pregunta_validacion_5",
        "pregunta_validacion_6",
        "pregunta_validacion_7",
        "pregunta_validacion_8",
        "valor_multa",
        "pregunta_validacion_9",
        "valor_reporte",
        "pregunta_validacion_10",
        "empresa_trabajo",
        "autorizacion",
        "observacion_preguntas",
        "concepto_final_preg_1",
        "concepto_final_preg_2",
        "concepto_final_preg_3",
        "concepto_final"
    ];

    public function getRequerimientos()
    {
        return $this->hasMany("App\Models\ProcesoRequerimiento", "entidad_id", "id")->where("tipo_entidad", "MODULO_ENTREVISTA_SEMIESTRUCTURDA")->get();
    }

    public function getRequerimientosActivos($req)
    {
        return $this->hasMany("App\Models\ProcesoRequerimiento", "entidad_id", "id")->where("tipo_entidad", "MODULO_ENTREVISTA_SEMIESTRUCTURDA")->where("requerimiento_id",$req)->where("activo",1)->first();
    }

    public function getDescripcion()
    {

        $competenciasEvaluadas = CalificaCompetencia::where("entidad_id", $this->id)->where("tipo_entidad", "MODULO_ENTREVISTA_SEMIESTRUCTURDA")->get();

        $arrayValores     = [];
        $arrayDescripcion = [];

        foreach ($competenciasEvaluadas as $key => $value) {
            $arrayValores[$value->competencia_entrevista_id]     = $value->valor;
            $arrayDescripcion[$value->competencia_entrevista_id] = $value->descripcion;
        }

        //$califica->competencia = $arrayValores;
        //$califica->descripcion = $arrayDescripcion;

        return $arrayDescripcion;
    }

    public function getCompetencias()
    {

        $competenciasEvaluadas = CalificaCompetencia::where("entidad_id", $this->id)->where("tipo_entidad", "MODULO_ENTREVISTA_SEMIESTRUCTURDA")->get();

        $arrayValores     = [];
        $arrayDescripcion = [];

        foreach ($competenciasEvaluadas as $key => $value) {
            $arrayValores[$value->competencia_entrevista_id]     = $value->valor;
            $arrayDescripcion[$value->competencia_entrevista_id] = $value->descripcion;
        }

        //$califica->competencia = $arrayValores;
        //$califica->descripcion = $arrayDescripcion;
        return $arrayValores;
    }

    public function getNamePsicologo()
    {

        $name = User::select("name")->where("id", $this->user_gestion_id)->first();

        return $name["name"];
    }


}


  