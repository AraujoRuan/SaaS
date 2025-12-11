<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->enum('type', ['credit_purchase', 'subscription', 'service_payment', 'refund', 'bonus']);
            $table->decimal('amount', 10, 2);
            $table->decimal('balance_before', 10, 2);
            $table->decimal('balance_after', 10, 2);
            $table->enum('status', ['pending', 'completed', 'failed', 'refunded'])->default('pending');
            $table->string('payment_method')->nullable();
            $table->string('payment_gateway')->nullable();
            $table->string('payment_id')->nullable();
            $table->string('pix_code')->nullable();
            $table->timestamp('pix_expires_at')->nullable();
            $table->json('metadata')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'type', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
