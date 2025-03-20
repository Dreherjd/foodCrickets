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
        Schema::create('tags_posts', function (Blueprint $table) {
            $table->id()->primary();
            $table->timestamps();
            $table->foreignUuid('post_id')->constrained('posts','id');
            $table->integer('tag_id')->constrained('tags','id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags_posts');
    }
};
