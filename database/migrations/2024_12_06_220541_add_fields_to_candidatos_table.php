<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToCandidatosTable extends Migration
{
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            // Adicionando novos campos ao perfil do candidato
            $table->string('foto')->nullable(); // Foto do candidato (opcional)
            $table->text('descricao')->nullable(); // Descrição do candidato (opcional)
            $table->string('telefone')->nullable(); // Telefone do candidato (opcional)
            $table->string('habilidades')->nullable(); // Habilidades do candidato (opcional)
        });
    }

    public function down()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            // Removendo os campos apenas se existirem
            if (Schema::hasColumn('candidatos', 'foto')) {
                $table->dropColumn('foto');
            }
            if (Schema::hasColumn('candidatos', 'descricao')) {
                $table->dropColumn('descricao');
            }
            if (Schema::hasColumn('candidatos', 'telefone')) {
                $table->dropColumn('telefone');
            }
            if (Schema::hasColumn('candidatos', 'habilidades')) {
                $table->dropColumn('habilidades');
            }
        });
    }
}
