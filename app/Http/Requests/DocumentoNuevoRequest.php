<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\TipoDocumento;

class DocumentoNuevoRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            "tipo_documento_id" => "required",
            "archivo_documento" => "required",
            "archivo_documento" => "mimes:jpg,jpeg,png,pdf,gif",
            "archivo_documento"=>   "max:5120",
            "descripcion_archivo" => "required"
        ];
    }

    public function messages() {
        return[
            "archivo_documento.required"=>"Debe seleccionar al menos 1 archivo",
            "archivo_documento.max"=>"El archivo no debe exceder un peso limite de 5 MB",
            "archivo_documento.mimes"=>"Tipo de archivo incorrecto"
        ];
    }

    /*public function response(array $errors) {
        //$campos = $this->all();
        //$tipoDocumento = ["" => "Seleccionar"] + TipoDocumento::where("active", "1")->pluck("descripcion", "id")->toArray();

        //return response()->json(["success" => false, "errors" => view("cv.modal.fr_documentos", compact("campos", "tipoDocumento"))->withErrors($errors)->render()]);
        return response()->json(["success"=>false,"errors"=>$errors]);
    }*/

}
