<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAtivoColumnInEmpregadoresTable extends Migration
{
    /**
     * Execute as alterações.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Define o valor padrão da coluna 'ativo' como 1
            $table->boolean('ativo')->default(1)->change();
        });
    }

    /**
     * Rever as alterações.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Reverte a alteração, se necessário
            $table->boolean('ativo')->default(0)->change();
        });
    }
}
