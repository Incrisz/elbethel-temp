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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->integer('CA1');
            $table->integer('CA2');
            $table->integer('CA3');
            $table->integer('exam');
            $table->integer('total_marks');
            $table->string('grade');
            $table->integer('position_in_subject');
            $table->decimal('class_average', 5, 2);
            $table->integer('lowest_in_class');
            $table->integer('highest_in_class');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};
