<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorrespondenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('correspondencia', function (Blueprint $table) {
            $table->id('id_correspondencia');
            $table->string('no_oficio');
            $table->timestamp('fecha_oficio')->nullable();
            $table->string('enviado_por');
            $table->string('asunto');
            $table->string('area');
            $table->string('folder');
            $table->string('recibido_por');
            $table->timestamp('fecha_recibido')->nullable();
            $table->string('se_contesta');
            $table->timestamp('fecha_contestado')->nullable();
            $table->string('contestado_con');
            $table->integer('creado_por');
            $table->timestamp('fecha_creado')->nullable();
            $table->integer('modificado_por');
            $table->timestamp('fecha_modificado')->nullable();
          
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('correspondencia');
    }
}
