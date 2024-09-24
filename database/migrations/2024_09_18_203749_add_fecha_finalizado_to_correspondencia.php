<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFechaFinalizadoToCorrespondencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('correspondencia', function (Blueprint $table) {
            //
            $table->string('fecha_finalizado',20)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('correspondencia', function (Blueprint $table) {
            //
            $table->dropColumn('fecha_finalizado');
        });
    }
}
