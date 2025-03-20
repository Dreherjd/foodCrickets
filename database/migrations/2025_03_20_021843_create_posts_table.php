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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->longText('content');
            $table->decimal('rating',2,2)->nullable();
            $table->integer('dollar_rating')->nullable();
            $table->boolean('hall_of_fame')->default(false);
            $table->boolean('would_go_back')->default(false);
            $table->string('business_name')->nullable();
            $table->string('business_addr')->nullable();
            $table->string('pic_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
