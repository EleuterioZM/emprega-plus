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
        Schema::table('comentarios', function (Blueprint $table) {
            $table->unsignedBigInteger('empregador_id')->nullable()->after('job_post_id');
        });
    }
    
    public function down()
    {
        Schema::table('comentarios', function (Blueprint $table) {
            $table->dropColumn('empregador_id');
        });
    }
    
};
