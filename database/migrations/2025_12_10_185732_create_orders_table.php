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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'processing', 'completed', 'failed', 'refunded'])->default('pending');
            $table->decimal('amount', 10, 2);
            $table->integer('credits_used')->default(0);
            $table->json('input_data');
            $table->json('output_data')->nullable();
            $table->text('notes')->nullable();
            $table->string('attachment_path')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->index(['user_id', 'status']);
            $table->index(['service_id', 'status']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
