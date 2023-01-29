<?php

namespace App\Http\Controllers;

use App\Models\Sitio;

use App\Http\Requests;
use App\Models\DatosBasicos;
use Illuminate\Http\Request;
use App\Models\Requerimiento;
use App\Models\RegistroProceso;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\PruebaCompetenciaReq;
use App\Models\PruebaCompetenciaCargo;
use App\Models\PruebaCompetenciaTotal;
use App\Models\PruebaCompetenciaDirecta;
use App\Models\PruebaCompetenciaInversa;
use App\Models\PruebaCompetenciaResultado;
use App\Models\PruebaCompetenciaCandidatoHistorico;
use App\Models\PruebaCompetenciaSolaCandidatoHistorico;
use App\Models\User;

class TestCodeController extends Controller
{
	public function test(Request $data)
	{
		$roles_id = explode(",", $data->roles_id);
		$emails = emails_rol_cliente_agencia($data->req_id, $roles_id);

		$otro = User::join('users_x_clientes','users_x_clientes.user_id', '=', 'users.id')
			->join('role_users','role_users.user_id', '=', 'users.id')            
			->join('clientes', 'clientes.id', '=', 'users_x_clientes.cliente_id')
			->join('negocio', 'negocio.cliente_id', '=', 'clientes.id')
			->join('requerimientos', 'requerimientos.negocio_id', '=', 'negocio.id')
			->join('ciudad', function ($join) {
				$join->on('requerimientos.ciudad_id', '=', 'ciudad.cod_ciudad')
					->on('requerimientos.departamento_id', '=', 'ciudad.cod_departamento')
					->on('requerimientos.pais_id', '=', 'ciudad.cod_pais');
			})
			->join("agencias", "agencias.id", "=", "ciudad.agencia")
			->where('requerimientos.id', $data->req_id)
			->whereIn('role_users.role_id', $roles_id)
			->select(
				"users.email as email",
				"users.name",
				"clientes.nombre as cliente_nombre",
				"users.id"
			)
			->groupBy("users.id")
		->get();

		dd($emails, $otro);
	}
}
