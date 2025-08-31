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
            $table->string('rut',12)->unique();
            $table->string('name');
            $table->string('last_name_paternal');
            $table->string('last_name_maternal');
            $table->string('full_name')->virtualAs("concat(name,' ',last_name_paternal,' ',last_name_maternal)");
            $table->date('birth_date');
            $table->text('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_emergency')->nullable();
            $table->string('email')->nullable()->unique();
            $table->enum('gender', ['Masculino', 'Femenino', 'Otro']);
            $table->foreignId('grade_id')->nullable()->constrained('grades')->onDelete('set null');
            $table->foreignId('representative_id')->nullable()->constrained('representatives')->onDelete('set null');
            $table->boolean('use_image')->default(false);
            $table->string('password');
            $table->date('admission_date');
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
