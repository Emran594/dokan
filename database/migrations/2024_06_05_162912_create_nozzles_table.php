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
        Schema::create('nozzles', function (Blueprint $table) {
            $table->id();
            $table->string('nozzle_name');
            $table->string('nozzle_name_bangla');
            $table->foreignId('tank_id')->constrained('tanks')->onDelete('cascade');
            $table->decimal('current_meter_reading',10,4); // Updated column name
            $table->string('status');
            $table->timestamps(); // Includes both created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nozzles');
    }
};
