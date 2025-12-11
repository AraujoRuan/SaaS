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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->enum('type', ['credit', 'subscription', 'one_time']);
            $table->integer('required_credits')->default(1);
            $table->json('input_fields')->nullable();
            $table->json('output_fields')->nullable();
            $table->text('processing_instructions')->nullable();
            $table->string('api_endpoint')->nullable();
            $table->string('api_key')->nullable();
            $table->integer('processing_time')->default(5); // em minutos
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('services');
    }
};
