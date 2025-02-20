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
        Schema::create('assessments', function (Blueprint $table) {
            $table->bigIncrements('assessment_id');
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('subject_id');
            $table->integer('CA1')->nullable();
            $table->integer('CA2')->nullable();
            $table->integer('CA3')->nullable();
            $table->integer('exam')->nullable();
            $table->integer('position_in_subject')->nullable();
            $table->decimal('class_average', 5, 2)->nullable();
            $table->integer('lowest_in_class')->nullable();
            $table->integer('highest_in_class')->nullable();
            $table->string('term'); // e.g., "First Term"
            $table->string('academic_year');
            $table->timestamps();

            $table->foreign('student_id')->references('student_id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('subject_id')->on('subjects')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
