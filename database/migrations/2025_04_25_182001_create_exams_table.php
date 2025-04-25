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
        Schema::create('exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->date('exam_date');
            $table->foreignId('previous_grade_id')->constrained('grades')->onDelete('restrict');
            $table->foreignId('current_grade_id')->nullable()->constrained('grades')->onDelete('set null');
            $table->enum('result',['aprobado','reprobado','pendiente'])->nullable();
            $table->float('score')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};
