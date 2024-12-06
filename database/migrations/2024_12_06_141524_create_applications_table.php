<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    public function up()
    {
        // Verificar se a tabela 'applications' já existe
        if (!Schema::hasTable('applications')) {
            Schema::create('applications', function (Blueprint $table) {
                $table->id(); // Cria a coluna id como chave primária
                $table->unsignedBigInteger('job_id'); // Chave estrangeira para a vaga
                $table->unsignedBigInteger('candidato_id'); // Chave estrangeira para o candidato (usuário)
                $table->enum('status', ['pendente', 'aceita', 'rejeitada'])->default('pendente'); // Status da candidatura
                $table->timestamps(); // Colunas created_at e updated_at

                // Chave estrangeira para a tabela `job_posts`, associando a candidatura à vaga
                $table->foreign('job_id')->references('id')->on('job_posts')->onDelete('cascade');

                // Chave estrangeira para a tabela `users`, associando a candidatura ao candidato
                $table->foreign('candidato_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('applications'); // Deleta a tabela caso o rollback seja necessário
    }
}
