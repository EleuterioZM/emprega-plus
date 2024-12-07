<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToEmpregadoresTable extends Migration
{
    public function up()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Adicionando novos campos ao perfil do empregador
            $table->text('empresa_descricao')->nullable(); // Descrição da empresa (opcional)
            $table->string('telefone')->nullable(); // Telefone da empresa (opcional)
            $table->string('site')->nullable(); // Site da empresa (opcional)
        });
    }

    public function down()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Removendo os campos em caso de rollback
            $table->dropColumn(['empresa_descricao', 'telefone', 'site']);
        });
    }
}
