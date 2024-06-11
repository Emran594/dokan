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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->foreignId('shift_id')->constrained('shifts')->onDelete('cascade');
            $table->foreignId('nozzle_id')->constrained('nozzles')->onDelete('cascade');
            $table->decimal('opening_reading', 10, 4);
            $table->decimal('closing_reading', 10, 4);
            $table->decimal('sale_qty', 10, 4);
            $table->decimal('sale_amount', 10, 4); // Use decimal for monetary values
            $table->string('status');
            $table->timestamps(); // Includes both created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
