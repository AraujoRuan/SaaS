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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained()->onDelete('set null');
            $table->string('ticket_number')->unique();
            $table->string('subject');
            $table->text('message');
            $table->enum('status', ['open', 'answered', 'closed', 'pending'])->default('open');
            $table->enum('priority', ['low', 'medium', 'high', 'urgent'])->default('medium');
            $table->json('attachments')->nullable();
            $table->timestamps();
            $table->timestamp('closed_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
