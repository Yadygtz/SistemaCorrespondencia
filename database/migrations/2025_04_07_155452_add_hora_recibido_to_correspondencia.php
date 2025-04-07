<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHoraRecibidoToCorrespondencia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('correspondencia', function (Blueprint $table) {
            $table->time('hora_recibido');
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
            $table->dropColumn('hora_recibido');
        });
    }
}
