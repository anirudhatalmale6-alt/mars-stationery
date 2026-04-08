<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('order_number')->unique();
            $table->foreignId('address_id')->nullable()->constrained('addresses')->nullOnDelete();
            $table->string('delivery_name');
            $table->string('delivery_phone', 20);
            $table->text('delivery_address');
            $table->string('delivery_city');
            $table->string('delivery_state');
            $table->string('delivery_postal_code', 20);
            $table->decimal('subtotal', 10, 2);
            $table->decimal('delivery_charge', 10, 2)->default(0);
            $table->decimal('total', 10, 2);
            $table->integer('total_weight')->default(0);
            $table->enum('payment_method', ['cod', 'bank_transfer', 'online']);
            $table->enum('payment_status', ['pending', 'verified', 'failed'])->default('pending');
            $table->enum('order_status', ['payment_pending', 'processing', 'shipped', 'completed', 'cancelled'])->default('payment_pending');
            $table->string('bank_receipt_image')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
