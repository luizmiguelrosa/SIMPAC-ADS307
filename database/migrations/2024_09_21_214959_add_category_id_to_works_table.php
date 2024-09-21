<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable()->after('evaluative_model_id'); // Adicione a coluna
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null'); // Defina a chave estrangeira, se necessário
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('works', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Remove a chave estrangeira
            $table->dropColumn('category_id'); // Remove a coluna
        });
    }
};
