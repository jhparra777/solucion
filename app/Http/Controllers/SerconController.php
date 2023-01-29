<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Sercon as ModeloTabla;
use App\Models\Clientes;

class SerconController extends Controller
{
    
    public function index(Request $request)
    {   
        $clientes = ["" => "Seleccionar"] + Clientes::orderBy("clientes.nombre","ASC")->pluck("clientes.nombre", "clientes.id")->toArray();
        
        $listas = ModeloTabla::join("clientes", "clientes.id", "=", "sercon.cliente_id")
                    ->select(
                        "sercon.*",
                        "clientes.nombre as cliente"
                    )
                    ->active($request)
                    ->cliente($request)
                    ->paginate(10);

        return view("admin.sercon.index", compact("listas", "clientes"));
    }

    public function nuevo(Request $data)
    {
        $clientes = ["" => "Seleccionar"] + Clientes::orderBy("clientes.nombre","ASC")->pluck("clientes.nombre", "clientes.id")->toArray();
        
        return view("admin.sercon.nuevo", compact('clientes'));
    }

    public function guardar(Request $request, Requests\SerconRequest $valida)
    {

        $registro = new ModeloTabla();
        $registro->create($request->all());

        return redirect()->route("admin.sercon.index")->with("mensaje_success", "¡Registro creado con éxito!");
    }

    public function editar($id)
    {
        $registro = ModeloTabla::findOrFail($id);
        $clientes = ["" => "Seleccionar"] + Clientes::orderBy("clientes.nombre","ASC")->pluck("clientes.nombre", "clientes.id")->toArray();
        
        return view("admin.sercon.editar", compact("registro", "clientes"));
    }

    public function actualizar(Request $request, Requests\SerconRequest $valida)
    {   
        $registro = ModeloTabla::find($request->get("id"));

        $registro->update($request->all());

        return redirect()->route("admin.sercon.index")->with("mensaje_success", "¡Registro actualizado con éxito!");
    }

    public function cambiarEstado($id)
    {   
        $sercon = decrypt($id);

        $registro = ModeloTabla::findOrFail($sercon);

        $registro->update(["active" => !$registro->active]);

        return redirect()->route("admin.sercon.index")->with("mensaje_success", "¡Estado cambiado con éxito!");
    }

}
