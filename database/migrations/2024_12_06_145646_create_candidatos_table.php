<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCandidatosTable extends Migration
{
    public function up()
    {
        Schema::create('candidatos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona com a tabela `users`
            $table->string('cv')->nullable(); // Campo para o upload do CV (opcional)
            $table->string('portfolio')->nullable(); // Campo para o portfólio (opcional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('candidatos');
    }
}
