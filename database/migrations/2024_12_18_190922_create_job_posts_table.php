<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empregador_id'); // Referência ao empregador
            $table->string('titulo');
            $table->text('descricao');
            $table->string('localizacao');
            $table->enum('tipo', ['tempo integral', 'meio período', 'freelance']); // Tipos de vagas
            $table->decimal('salario', 10, 2)->nullable(); // Salário (opcional)
            $table->string('documento_pdf')->nullable(); // Caminho do arquivo PDF
            $table->date('validade'); // Data de validade da vaga
            $table->boolean('ativo')->default(true); // Status da vaga
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('empregador_id')->references('id')->on('empregadores')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('job_posts');
    }
}
