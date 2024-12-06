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
        Schema::table('empregadores', function (Blueprint $table) {
            $table->renameColumn('empresa_nome', 'company_name');
        });
    }
    
    public function down()
    {
        Schema::table('empregadores', function (Blueprint $table) {
            $table->renameColumn('company_name', 'empresa_nome');
        });
    }
    
};
