<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtivoToEmpregadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Adiciona a coluna 'ativo' como booleano
            $table->boolean('ativo')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Remove a coluna 'ativo' se a migration for revertida
            $table->dropColumn('ativo');
        });
    }
}
