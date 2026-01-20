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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->id();
            $table->foreignId('user_id')->constrained(
                table: 'users',
                indexName: 'orders_user_id'
            )->cascadeOnDelete();
            $table->string('order_code')->unique();
            $table->string('status')->default('pending')->index();
            $table->decimal('total_price', 12, 2);
            $table->text('shipping_address')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_reference')->nullable();
            $table->timestamp('paid_at');
            $table->timestamps();
            $table->softDeletes();
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
