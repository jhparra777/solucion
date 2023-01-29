<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Models\TipoDocumento;

class DocumentoEditarRequest extends Request {

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
            "archivo_documento.*" => "mimes:jpg,jpeg,png,pdf,gif",
            "descripcion_archivo" => "required",
        ];
    }

    public function messages() {
        return[
            "archivo_documento.mimes" => "Tipo de archivo incorrecto"
        ];
    }

    public function response(array $errors) {
        $campos = $this->all();
        $tipoDocumento = ["" => "Seleccionar"] + TipoDocumento::where("active", "1")->pluck("descripcion", "id")->toArray();
        $editar = true;
        return response()->json(["success" => false, "view" => view("cv.modal.fr_documentos", compact("campos", "tipoDocumento","editar"))->withErrors($errors)->render()]);
    }

}
