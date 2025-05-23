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
        Schema::create('championship_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('types',['Kup','Dan']);
            $table->string('category')->virtualAs("concat(name,' - ',types)");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('championship_categories');
    }
};
