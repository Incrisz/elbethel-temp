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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('adm_no')->unique();
            $table->integer('no_of_days_present');
            $table->string('class');
            $table->integer('marks_obtainable');
            $table->integer('marks_obtained');
            $table->decimal('average', 5, 2);
            $table->string('position');
            $table->text('teacher_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
