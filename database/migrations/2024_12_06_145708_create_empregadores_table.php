<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpregadoresTable extends Migration
{
    public function up()
    {
        Schema::create('empregadores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela `users`
            $table->string('empresa_nome'); // Campo para o nome da empresa
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('empregadores');
    }
}
