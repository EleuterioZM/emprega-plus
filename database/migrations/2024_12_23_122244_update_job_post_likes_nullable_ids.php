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
            $table->unsignedBigInteger('candidato_id')->nullable()->change();
            $table->unsignedBigInteger('empregador_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('job_post_likes', function (Blueprint $table) {
            $table->unsignedBigInteger('candidato_id')->nullable(false)->change();
            $table->unsignedBigInteger('empregador_id')->nullable(false)->change();
        });
    }
    
};
