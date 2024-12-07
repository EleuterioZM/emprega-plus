<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocalizacaoToEmpregadoresTable extends Migration
{
    public function up()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            $table->string('localizacao')->nullable(); // Adicionando o campo 'localizacao'
        });
    }

    public function down()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            $table->dropColumn('localizacao'); // Removendo o campo 'localizacao' em caso de rollback
        });
    }
}
