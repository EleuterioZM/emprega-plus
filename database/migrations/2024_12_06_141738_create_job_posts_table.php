<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id(); // Cria a coluna id como chave primária
            $table->string('title'); // Título da vaga
            $table->text('description'); // Descrição da vaga
            $table->enum('status', ['aberta', 'fechada'])->default('aberta'); // Status da vaga
            $table->unsignedBigInteger('empregador_id'); // Chave estrangeira para o empregador (usuário)
            $table->timestamps(); // Colunas created_at e updated_at

            // Chave estrangeira para a tabela `users`, associando a vaga ao empregador
            $table->foreign('empregador_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posts'); // Deleta a tabela caso o rollback seja necessário
    }
}
