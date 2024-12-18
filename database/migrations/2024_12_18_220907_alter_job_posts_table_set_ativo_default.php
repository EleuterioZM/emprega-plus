<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterJobPostsTableSetAtivoDefault extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('job_posts', function (Blueprint $table) {
            // Alterando o campo 'ativo' para ter o valor padrão como true
            $table->boolean('ativo')->default(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
     {
         Schema::table('job_posts', function (Blueprint $table) {
            // Revertendo a alteração, caso seja necessário
            $table->boolean('ativo')->default(false)->change();
         });
     }
}
