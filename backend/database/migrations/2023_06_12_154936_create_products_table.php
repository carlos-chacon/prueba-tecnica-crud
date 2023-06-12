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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 120);
            $table->text('description');
            $table->double('price', 8, 2);
            $table->bigInteger('quantity');
            $table->string('image', 500);
            $table->string('category', 120);
            $table->string('brand', 120);
            $table->string('sku', 500);
            $table->string('weight', 100);
            $table->string('dimensions', 100);
            $table->boolean('featured');
            $table->boolean('on_sale');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
