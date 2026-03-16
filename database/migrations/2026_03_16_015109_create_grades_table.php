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
        Schema::create('grades', function (Blueprint $table) {
        $table->id();
        $table->foreignId('student_id')->constrained()->onDelete('cascade');
        $table->foreignId('course_id')->constrained()->onDelete('cascade');
        $table->decimal('midterm', 5, 2)->nullable();
        $table->decimal('final', 5, 2)->nullable();
        $table->decimal('total', 5, 2)->nullable();
        $table->string('letter_grade')->nullable();
        $table->enum('status', ['pass', 'fail', 'pending'])->default('pending');
        $table->timestamps();
        $table->unique(['student_id', 'course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
