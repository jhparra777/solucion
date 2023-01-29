<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sercon extends Model
{
    protected $table = 'sercon';

    protected $guarded = ['id'];

    //relatioship
    public function cliente()
    {
        return $this->belongsTo('App\Models\Clientes');
    }

    //query scope
    public function scopeCliente($query, $data){
        
        if( $data->has("cliente_id") && $data->get("cliente_id") != "" ){
    		return $query->where('sercon.cliente_id', $data->get("cliente_id"));
    	}

    }

    public function scopeActive($query, $data)
    {	
    	if( $data->has("active") && $data->get("active") != "" ){
    		return $query->where('sercon.active', $data->get("active"));
    	}
    }
}
