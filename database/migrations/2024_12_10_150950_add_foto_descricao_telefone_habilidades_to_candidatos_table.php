<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFotoDescricaoTelefoneHabilidadesToCandidatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            // Verifica e adiciona a coluna 'foto'
            if (!Schema::hasColumn('candidatos', 'foto')) {
                $table->string('foto')->nullable();
            }

            // Verifica e adiciona a coluna 'descricao'
            if (!Schema::hasColumn('candidatos', 'descricao')) {
                $table->text('descricao')->nullable();
            }

            // Verifica e adiciona a coluna 'telefone'
            if (!Schema::hasColumn('candidatos', 'telefone')) {
                $table->string('telefone', 15)->nullable();
            }

            // Verifica e adiciona a coluna 'habilidades'
            if (!Schema::hasColumn('candidatos', 'habilidades')) {
                $table->string('habilidades', 255)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            // Remove as colunas caso existam
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
