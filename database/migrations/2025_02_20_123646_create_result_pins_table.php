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
        Schema::create('result_pins', function (Blueprint $table) {
            $table->bigIncrements('pin_id');
            $table->string('pin_code')->unique();
            // Optionally, link to a student or assessment
            $table->foreignId('student_id')->constrained('students', 'student_id');
            $table->foreignId('assessment_id')->constrained('assessments', 'assessment_id');
            $table->boolean('is_used')->default(false);
            $table->dateTime('expiry_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('result_pins');
    }
};
