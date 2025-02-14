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
        Schema::create('skills_behavior', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->integer('attentiveness')->default(1);
            $table->integer('perseverance')->default(1);
            $table->integer('promptness')->default(1);
            $table->integer('communication_skills')->default(1);
            $table->integer('handwriting')->default(1);
            $table->integer('punctuality')->default(1);
            $table->integer('neatness')->default(1);
            $table->integer('politeness')->default(1);
            $table->integer('honesty')->default(1);
            $table->integer('self_control')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skills_behavior');
    }
};
