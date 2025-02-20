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
        Schema::create('terms', function (Blueprint $table) {
            $table->bigIncrements('term_id');
            $table->unsignedBigInteger('session_id');
            $table->string('name'); // e.g., "1st Term", "2nd Term", "3rd Term"
            $table->timestamps();

            $table->foreign('session_id')->references('session_id')->on('sessions')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terms');
    }
};
