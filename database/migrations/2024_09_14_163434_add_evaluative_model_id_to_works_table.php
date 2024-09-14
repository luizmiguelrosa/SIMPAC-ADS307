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
        $table->unsignedBigInteger('evaluative_model_id')->after('course_id');
        $table->foreign('evaluative_model_id')->references('id')->on('evaluative_models')->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('works', function (Blueprint $table) {
        $table->dropForeign(['evaluative_model_id']);
        $table->dropColumn('evaluative_model_id');
    });
}

};
