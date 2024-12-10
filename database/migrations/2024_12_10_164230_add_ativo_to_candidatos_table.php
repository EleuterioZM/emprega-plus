<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAtivoToCandidatosTable extends Migration
{
    public function up()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->boolean('ativo')->default(1);  // 1 = Ativo, 0 = Desativado
        });
    }

    public function down()
    {
        Schema::table('candidatos', function (Blueprint $table) {
            $table->dropColumn('ativo');
        });
    }
}
