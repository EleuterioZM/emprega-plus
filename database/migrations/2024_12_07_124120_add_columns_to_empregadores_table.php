<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEmpregadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            // Adicionar a coluna para a imagem de perfil se não existir
            if (!Schema::hasColumn('empregadores', 'profile_image')) {
                $table->string('profile_image')->nullable();
            }

            // Adicionar a coluna para o endereço se não existir
            if (!Schema::hasColumn('empregadores', 'endereco')) {
                $table->string('endereco')->nullable();
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
        Schema::table('empregadores', function (Blueprint $table) {
            // Remover as colunas em caso de rollback
            $table->dropColumn(['profile_image', 'endereco']);
        });
    }
}
