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
        Schema::create('skill_behaviours', function (Blueprint $table) {
            $table->bigIncrements('skill_behaviour_id');
            $table->unsignedBigInteger('student_id');
            $table->tinyInteger('attentiveness')->nullable();
            $table->tinyInteger('perseverance')->nullable();
            $table->tinyInteger('promptness')->nullable();
            $table->tinyInteger('communication_skills')->nullable();
            $table->tinyInteger('handwriting')->nullable();
            $table->tinyInteger('punctuality')->nullable();
            $table->tinyInteger('neatness')->nullable();
            $table->tinyInteger('politeness')->nullable();
            $table->tinyInteger('honesty')->nullable();
            $table->tinyInteger('self_control')->nullable();
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_behaviours');
    }
};
