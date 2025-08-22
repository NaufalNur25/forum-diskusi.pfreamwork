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
        Schema::create('answers', function (Blueprint $table) {
        $table->uuid('answer_id')->primary();
        $table->uuid('user_id');
        $table->uuid('comment_id');
        $table->uuid('parent_id')->nullable();
        $table->string('answer')->nullable();
        $table->text('content')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
