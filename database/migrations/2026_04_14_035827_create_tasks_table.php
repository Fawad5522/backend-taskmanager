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
    Schema::create('tasks', function (Blueprint $table) {
        $table->id(); // Task ki unique ID
        $table->string('title'); // Task ka naam
        $table->text('description')->nullable(); // Task ki detail
        $table->string('status')->default('pending'); // Pending ya Completed
        $table->timestamps(); // Kab bana aur kab update hua
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
