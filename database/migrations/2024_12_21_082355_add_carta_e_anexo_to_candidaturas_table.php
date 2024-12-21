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
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->text('carta_candidatura')->nullable()->after('job_post_id');
            $table->string('anexo')->nullable()->after('carta_candidatura');
        });
    }
    
    public function down()
    {
        Schema::table('candidaturas', function (Blueprint $table) {
            $table->dropColumn(['carta_candidatura', 'anexo']);
        });
    }
    
};
