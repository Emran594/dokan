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
        Schema::create('tanks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_bangla');
            $table->decimal('tank_size', 10, 4);
            $table->decimal('opening_stock', 10, 4);
            $table->decimal('purchase_price', 10, 4);
            $table->decimal('sell_price', 10, 4);
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanks');
    }
};
