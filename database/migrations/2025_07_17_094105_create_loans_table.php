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
        Schema::create('loans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
            $table->datetime('loaned_at');
            $table->datetime('expected_return_date');
            $table->datetime('returned_at')->nullable();
            $table->foreignId('loaned_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('returned_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('status', ['activo', 'devuelto', 'vencido', 'perdido'])->default('activo');
            $table->text('loan_notes')->nullable();
            $table->text('return_notes')->nullable();
            $table->enum('equipment_condition_loan', ['excelente', 'bueno', 'regular', 'malo'])->default('excelente');
            $table->enum('equipment_condition_return', ['excelente', 'bueno', 'regular', 'malo'])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loans');
    }
};
