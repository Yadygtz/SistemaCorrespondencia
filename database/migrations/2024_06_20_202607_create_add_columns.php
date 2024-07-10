<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('paterno');
            $table->string('materno');
            $table->string('clave');
            $table->string('tipo_usuario');
            $table->string('area');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(array_merge([
                'paterno',
                'materno',
                'clave',
                'tipo_usuario',
                'area'
            ]));
        });
    }
}

