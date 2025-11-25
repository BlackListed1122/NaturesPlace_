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
        Schema::create('records', function (Blueprint $table) {

            $table->id();
            $table->json('product_id')->nullable(); // ← one column to store IDs
            $table->json('name')->nullable(); // 
            $table->json('quantity')->nullable(); // 
            $table->json('price')->nullable(); // 
            $table->json('subtotal')->nullable(); // 
            $table->json('total')->nullable(); // 
            $table->json('active')->default(json_encode(['1' => true]));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
