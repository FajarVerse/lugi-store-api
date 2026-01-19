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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->string('size')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('weight')->nullable();
            $table->decimal('price', 10, 2);
            $table->foreignId('product_id')->constrained(
                table: 'products',
                indexName: 'variants_product_id'
            )->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
