<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisitaCandidato extends Model
{

    protected $table    = 'visitas_candidatos';
    protected $fillable = [
    	'candidato_id',
    	'requerimiento_id',
        'empresa_logo_id',
        'tipo_visita_id',
        'clase_visita_id',
        'numero_id',
    	'primer_nombre',
    	'segundo_nombre',
    	'primer_apellido',
    	'segundo_apellido',
        'fecha_nacimiento',
        'fecha_expedicion',
        'pais_id',
        'departamento_expedicion_id',
        'ciudad_expedicion_id',
        'grupo_sanguineo',
        'rh',
        'email',
        'estado_civil',
        'pais_residencia',
        'departamento_residencia',
        'ciudad_residencia',
        'direccion',
        'barrio',
        'nivel_escolaridad',
        'numero_libreta',
        'clase_libreta',
        'telefono_movil',
        'telefono_fijo',
        'tipo_familia',
        'lugar_ocupa',
        'tipo_vivienda',
        'propiedad',
        'nombre_arrendador',
        'telefono_arrendador',
        'nro_familias',
        'nro_pisos',
        'estrato',
        'nro_personas',
        'localidad_id',
        'sector',
        'facilidades_transporte',
        'tiempo_trabajo',
        'medio_utilizado',
        'tiempo_residencia_vivienda',
        'hay_milicias',
        'hay_pandillas',
        'hay_habitantes_calle',
        'hay_delincuencia',
        'observaciones_hurto',
        'material_techo',
        'material_paredes',
        'material_piso',
        'orden_entrevista',
        'observaciones_generales_vivienda',
        'ingresos_mensuales',
        'egresos_mensuales',
        'procedencia_ingresos_candidato',
        'procedencia_egresos_candidato',
        'ingresos_mensuales_conyugue',
        'procedencia_ingresos_conyugue',
        'otros_ingresos_candidato',
        'procedencia_otros_ingresos',
        'observaciones_ingresos',
        'observaciones_egresos',
        'observaciones_ingresos_egresos',
        'total_ingresos',
        'total_egresos',
        'ingreso_neto',
        'observaciones_reportes_negativos',
        'tiempo_compania',
        'cargo_compania',
        'observaciones_ascenso',
        'observaciones_encargo',
        'declarante_renta',
        'saldo_favor',
        'periodo_declaracion',
        'pago_total_renta',
        'observaciones_renta',
        'frecuencia_asistencia_medico',
        'por_que_frecuencia',
        'eps_evaluado',
        'interveciones',
        'enfermedades_familia',
        'otra_enfermedad_familiar',
        'observaciones_estado_salud',
        'dinamica_familiar',
        'comunicacion_nucleo_familiar',
        'cada_cuanto_nucleo_familiar',
        'buena_armonia_nucleo_familiar',
        'cuantas_comunica_nucleo',
        'hace_cuanto_vive_pareja',
        'cimiento_pareja',
        'educacion_hijos',
        'frecuencia_conversacion_familia',
        'aceptar_defectos',
        'preocupaciones_familia',
        'cualidades_evaluado',
        'aspectos_mejorar',
        'autodescripcion_personal',
        'autodescripcion_laboral',
        'ejerce_autoridad',
        'como_ejerce_autoridad',
        'reglas_familiares',
        'amor_familiar',
        'cualidades_nucleo_familiar',
        'metas_corto_plazo',
        'metas_largo_plazo',
        'ir_cine',
        'ir_centros_comerciales',
        'salir_parque',
        'ver_tv',
        'dormir_hasta_tarde',
        'ver_peliculas',
        'comparte_amigos',
        'cuanto_comparte_amigos',
        'realiza_quehaceres',
        'oficio_especifico',
        'practica_deporte',
        'tiene_hobby',
        'demas_familiares',
        'actividades_familiares_tiempo_libre',
        'nombres_apellidos_vecino',
        'nombres_apellidos_vecino_2',
        'parentesco_vecino',
        'parentesco_vecino_2',
        'telefono_vecino',
        'telefono_vecino_2',
        'tiempo_vecino',
        'tiempo_vecino_2',
        'concepto_general_visita'





    ];

    public function visita_admin(){
        return $this->hasOne("App\Models\VisitaAdmin");
    }
    
   

    //Funcion para asignar la descripcion en el reporte de informe seleccion
   

      
     

}
