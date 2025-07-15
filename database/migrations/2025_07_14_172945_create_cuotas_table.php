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
        Schema::create('cuotas', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->comment('Año de la cuota');
            $table->integer('amount')->comment('Monto de la cuota');
            $table->date('payment_date')->comment('Fecha de pago de la cuota');
            $table->string('observation')->nullable()->comment('Observación de la cuota');
            $table->enum('month', ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'])->comment('Mes de la cuota');
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('cuota_id')->constrained('valor_cuotas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cuotas');
    }
};
