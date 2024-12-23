<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('job_post_likes', function (Blueprint $table) {
            // Adicionando a coluna empregar_id
            $table->unsignedBigInteger('empregador_id')->nullable()->after('id');
    
            // Se você quiser criar uma chave estrangeira:
            // $table->foreign('empregador_id')->references('id')->on('empregadores')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::table('job_post_likes', function (Blueprint $table) {
            // Remover a coluna empregar_id
            $table->dropColumn('empregador_id');
        });
    }
    
};
