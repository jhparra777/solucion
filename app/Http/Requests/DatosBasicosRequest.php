<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class DatosBasicosRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if (route("home") == "http://komatsu.t3rsc.co" || route("home") == "https://komatsu.t3rsc.co") {
            return [
                "tipo_id"              => "required",
                "aspiracion_salarial"  =>"required",
                /* "password"  =>"required",*/
                //"txt_nacimiento" => "required",
                "numero_id"            => "required|numeric",
                //"fecha_expedicion"     => "required|date",
                "primer_nombre"        => "required",
                "primer_apellido"      => "required",
                "segundo_apellido"=>"required",
                "fecha_nacimiento"     => "required|date",
                "ciudad_nacimiento"=>"required",
                "telefono_movil"       => "numeric",
                "telefono_fijo"        => "numeric",
                //"ciudad_expedicion_id" => "required",
                "tipo_vehiculo"        => "required_if:tiene_vehiculo,1",
                //"numero_licencia"      => "required_if:tiene_vehiculo,1",
                //"categoria_licencia"   => "required_if:tiene_vehiculo,1",
               // "ciudad_residencia"    => "required",
                "email"                => "required|email",
                "foto"                 => "image|mimes:jpg,png",
                "foto"                 => "max:1500",
            ];
        }
        elseif(route("home") == "https://expertos.t3rsc.co"){
            return [
                "tipo_id"              => "required",
                //"aspiracion_salarial"  =>"required",
                "numero_id"            => "required|numeric",
                "nombres"              => "required",
                "primer_apellido"      => "required",
                "fecha_nacimiento"     => "required|date",
                //"ciudad_nacimiento"=>"required",
                //"genero"               => "required",
                "estado_civil"=>"required",
                "telefono_movil"       => "numeric",
                "direccion"            => "required",
                //"telefono_fijo"        => "numeric",
                //"ciudad_expedicion_id" => "required",
                "tipo_vehiculo"        => "required_if:tiene_vehiculo,1",
                //"numero_licencia"      => "required_if:tiene_vehiculo,1",
                //"categoria_licencia"   => "required_if:tiene_vehiculo,1",
                "ciudad_residencia"    => "required",

                "email"                => "required|email",
                "foto"                 => "image|mimes:jpg,png",
                "foto"                 => "max:1500",
                "numero_libreta" => "required_if:situacion_militar_definida,1",
                "clase_libreta" => "required_if:situacion_militar_definida,1",
                "distrito_militar" => "required_if:situacion_militar_definida,1"
            ];
        }
        elseif(route("home") == "https://gpc.t3rsc.co"){
            return [
                "tipo_id"              => "required",
                //"aspiracion_salarial"  =>"required",
                "numero_id"            => "required|numeric",
                "primer_nombre"        => "required",
                "primer_apellido"      => "required",
                "fecha_nacimiento"     => "required|date",
                "ciudad_nacimiento"    =>"required",
                //"genero"               => "required",
                "estado_civil"         =>"required",
                "telefono_movil"       => "numeric",
                "direccion"            => "required",
                //"telefono_fijo"        => "numeric",
                //"ciudad_expedicion_id" => "required",
                //"tipo_vehiculo"        => "required_if:tiene_vehiculo,1",
                //"numero_licencia"      => "required_if:tiene_vehiculo,1",
                //"categoria_licencia"   => "required_if:tiene_vehiculo,1",
                "ciudad_residencia"    => "required",
                "tipo_vivienda"        => "required",
                "email"                => "required|email",
                "foto"                 => "image|mimes:jpg,png",
                "foto"                 => "max:1500",
               // "archivo_documento"    => "required",
                "numero_hijos"         => "required",
                "tipo_vehiculo_t"      => "required",
                "numero_libreta" => "required_if:situacion_militar_definida,1",
                "clase_libreta" => "required_if:situacion_militar_definida,1",
                "distrito_militar" => "required_if:situacion_militar_definida,1"
            ];
        }
        elseif(route("home") == "https://vym.t3rsc.co" || route("home") == "https://listos.t3rsc.co"){
            return [
                "tipo_id"              => "required",
                "aspiracion_salarial"  =>"required",
                "numero_id"            => "required|numeric",
                "primer_nombre"        => "required",
                "primer_apellido"      => "required",
                "fecha_nacimiento"     => "required|date",
                "ciudad_nacimiento"    => "required",
                "genero"               => "required",
                "estado_civil"         => "required",
                "telefono_movil"       => "numeric",
                "telefono_fijo"        => "numeric",
                "direccion"            => "required",
                "barrio"               => "required",
                "ciudad_expedicion_id" => "required",
                "tipo_vehiculo"        => "required_if:tiene_vehiculo,1",
                //"numero_licencia"      => "required_if:tiene_vehiculo,1",
                //"categoria_licencia"   => "required_if:tiene_vehiculo,1",
                "ciudad_residencia"    => "required",
                "email"                => "required|email",
                "foto"                 => "image|mimes:jpg,png",
                "foto"                 => "max:1500",
                "numero_libreta" => "required_if:situacion_militar_definida,1",
                "clase_libreta" => "required_if:situacion_militar_definida,1",
                "distrito_militar" => "required_if:situacion_militar_definida,1"
            ];
        }
        else{
            return [
                "tipo_id"              => "required", 
                "aspiracion_salarial"  => "required", 
                "numero_id"            => "required|numeric", 
                "primer_nombre"        => "required", 
                "primer_apellido"      => "required", 
                "fecha_nacimiento"     => "required|date", 
                "ciudad_nacimiento"    => "required", 
                "genero"               => "required", 
                "estado_civil"         => "required", 
                "rh"                   => "required", 
                "grupo_sanguineo"      => "required", 
                "telefono_movil"       => "required|numeric",
                "telefono_fijo"        => "numeric",
                "direccion"            => "required", 
                "ciudad_expedicion_id" => "required",
                "tipo_vehiculo"        => "required_if:tiene_vehiculo,1",
                "numero_licencia"      => "required_if:tiene_vehiculo,1",
                "categoria_licencia"   => "required_if:tiene_licencia,1",
                "ciudad_residencia"    => "required",
                "email"                => "required|email",
                "foto"                 => "image|mimes:jpg,png",
                "foto"                 => "max:1500",
                "situacion_militar_definida" => "required_if:genero,1",
                "nombre_banco"         => "required_if:tiene_cuenta_bancaria,1",
                "tipo_cuenta"          => "required_if:tiene_cuenta_bancaria,1",
                "numero_cuenta"        => "required_if:tiene_cuenta_bancaria,1|confirmed",
                "numero_libreta"       => "required_if:situacion_militar_definida,1",
                "clase_libreta"        => "required_if:situacion_militar_definida,1",
                "distrito_militar"     => "required_if:situacion_militar_definida,1",
                "talla_zapatos"        => "required",  
                "talla_camisa"         => "required", 
                "talla_pantalon"       => "required",   
                "barrio"               => "required"
            ];
        }
    }

    public function messages()
    {
        if (route("home") == "http://komatsu.t3rsc.co" || route("home") == "https://komatsu.t3rsc.co") {
            return [
                "foto.image"                     => "La imagen debe estar en formato (jpg,png)",
                "foto.size"                      => "Su imagen debe  tener un peso máximo de  1.5MB.",
                "fecha_expedicion.required"      => "Debe seleccionar una fecha de expedicion",
                "nombre.required"                => "Debe digitar el nombre",
                "primer_apellido.required"       => "Debe digitar el primer apellido",
                "segundo_apellido.required"      => "Debe digitar el segundo apellido",
                "fecha_nacimiento.required"      => "Debe seleccionar una fecha de nacimiento",
                "ciudad_nacimiento.required"     => "Debe seleccionar un lugar de nacimiento",
                "aspiracion_salarial.required"   => "Debe seleccionar su aspiración salarial",       
                "categoria_licencia.required_if" => "Debe seleccionar una categoria.",
            ];
        }else if(route('home') == 'https://gpc.t3rsc.co' ){
            return [
                "foto.image"                     => "La imagen debe estar en formato (jpg,png)",
                "foto.size"                      => "Su imagen debe  tener un peso máximo de  1.5MB.",
                "fecha_expedicion.required"      => "Debe seleccionar una fecha de expedicion",
                "nombre.required"                => "Debe digitar el nombre",
                "primer_apellido.required"       => "Debe digitar el primer apellido",
                "segundo_apellido.required"      => "Debe digitar el segundo apellido",
                "fecha_nacimiento.required"      => "Debe seleccionar una fecha de nacimiento",
                "ciudad_nacimiento.required"     => "Debe seleccionar un lugar de nacimiento",
                "genero.required"                => "Debe seleccionar un género",
                "estado_civil.required"          => "Debe seleccionar un estado civil",
                "aspiracion_salarial.required"   => "Debe seleccionar su aspiración salarial",
                "ciudad_expedicion_id.required"  => "Debe seleccionar la ciudad de expedicion de la cédula",
                "ciudad_residencia.required"     => "Debe seleccionar la ciudad de residencia",
                "archivo_documento.required"     => "Debes subir el archivo de hoja de vida.",
                "tipo_vehiculo_t.required"       => "El campo tipo vehículo es obligatorio.",
                "numero_libreta.required_if" => "Debe digitar el numero libreta",
                "clase_libreta.required_if" => "Debe seleccionar una clase de libreta",
                "distrito_militar.required_if" => "Debe digitar el distrito militar libreta",
            ];
        }else{
            return [
                "foto.image"                     => "La imagen debe estar en formato (jpg,png)",
                "foto.size"                      => "Su imagen debe  tener un peso máximo de  1.5MB.",
                "fecha_expedicion.required"      => "Debe seleccionar una fecha de expedicion",
                "nombre.required"                => "Debe digitar el nombre",
                "primer_apellido.required"       => "Debe digitar el primer apellido",
                "segundo_apellido.required"      => "Debe digitar el segundo apellido",
                "fecha_nacimiento.required"      => "Debe seleccionar una fecha de nacimiento",
                "ciudad_nacimiento.required"     => "Debe seleccionar un lugar de nacimiento",
                "genero.required"                => "Debe seleccionar un género",
                "estado_civil.required"          => "Debe seleccionar un estado civil",
                "aspiracion_salarial.required"   => "Debe seleccionar su aspiración salarial",
                "ciudad_expedicion_id.required"  => "Debe seleccionar la ciudad de expedicion de la cédula",
                "ciudad_residencia.required"     => "Debe seleccionar la ciudad de residencia",
                "situacion_militar_definida.required_if" => "Debe seleccionar ¿Situación militar?",
                "nombre_banco.required_if"      => "Debe seleccionar un banco",
                "tipo_cuenta.required_if"      => "Debe seleccionar un tipo de cuenta",
                "numero_cuenta.required_if"      => "Debe digitar un número de cuenta",
                "tipo_vehiculo.required_if"      => "Debe seleccionar tipo de vehiculo",
                "numero_licencia.required_if"    => "Campo obligatorio.",
                "categoria_licencia.required_if" => "Debe seleccionar una categoria.",
                "numero_libreta.required_if" => "Debe digitar el numero libreta",
                "clase_libreta.required_if" => "Debe seleccionar una clase de libreta",
                "distrito_militar.required_if" => "Debe digitar el distrito militar libreta",
                "talla_zapatos"        => "Debe seleccionar talla de zapatos",  
                "talla_camisa"         => "Debe seleccionar talla de camisa", 
                "talla_pantalon"       => "Debe seleccionar talla de pantalon",
            ];
        }
    }
}
