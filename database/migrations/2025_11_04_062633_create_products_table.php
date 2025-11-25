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
        Schema::create('product_listings', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->string('flavor')->nullable();
            $table->string('category')->nullable();
            $table->string('size')->nullable();
            $table->string('price')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_listings', function (Blueprint $table) {

            $table->dropColumn([
                'name',
                'description',
                'flavor',
                'category',
                'size',
                'price',
                'avatar',

            ]);
        });
    }
};
