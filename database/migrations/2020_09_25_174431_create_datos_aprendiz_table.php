<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatosAprendizTable extends Migration
{   
    public $tableName = 'datos_aprendiz';
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('especialidad', 255)->nullable();
            $table->string('numero_grupo', 255)->nullable();
            $table->string('institucion', 255)->nullable();
            $table->string('sena_centro_formacion', 255)->nullable();
            $table->integer('datos_basicos_id');

            $table->index(["datos_basicos_id"], 'datos_basicos_id_foreign');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
