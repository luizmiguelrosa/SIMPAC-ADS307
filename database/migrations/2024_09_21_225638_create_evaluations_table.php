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
        Schema::create('evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('work_id')->constrained()->onDelete('cascade'); // Trabalho avaliado
            $table->foreignId('evaluator_id')->constrained('users')->onDelete('cascade'); // Avaliador
            $table->foreignId('evaluative_model_id')->constrained()->onDelete('cascade'); // Modelo avaliativo
            $table->json('responses'); // Respostas ou notas para as perguntas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluations');
    }
};
