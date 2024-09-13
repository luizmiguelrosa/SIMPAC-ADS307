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
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('symposium_id')->nullable();

            // Cria a foreign key referenciando a tabela 'symposium' (singular)
        $table->foreign('symposium_id')->references('id')->on('symposium')->onDelete('cascade');
    });
    }

    public function down()
{
    Schema::table('works', function (Blueprint $table) {
        // Remove a foreign key e a coluna 'symposium_id'
        $table->dropForeign(['symposium_id']);
        $table->dropColumn('symposium_id');
    });
    }

};
