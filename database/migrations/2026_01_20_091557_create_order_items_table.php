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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained(
                table: 'orders',
                indexName: 'order_items_order_id'
            )->cascadeOnDelete();
            $table->foreignId('variant_id')->constrained(
                table: 'variants',
                indexName: 'order_items_variant_id'
            )->cascadeOnDelete();
            $table->decimal('price', 12, 2);
            $table->decimal('subtotal', 12, 2);
            $table->unsignedInteger('quantity');
            $table->string('product_name');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
