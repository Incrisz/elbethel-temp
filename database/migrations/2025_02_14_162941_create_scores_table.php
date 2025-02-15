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
            $table->integer('ca1')->default(0); // or nullable()
            $table->integer('ca2')->default(0);
            $table->integer('ca3')->default(0);
            $table->integer('exam');
            $table->integer('total_marks')->virtualAs('ca1 + ca2 + ca3 + exam');
            $table->string('grade');
            $table->integer('position_in_subject');
            $table->integer('class_average');
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
