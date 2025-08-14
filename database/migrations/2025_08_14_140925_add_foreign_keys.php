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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('role_id')->change()->constrained('roles', 'role_id');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreignUuid('user_id')->change()->constrained('users', 'user_id');
            $table->foreignUuid('category_id')->change()->constrained('categories', 'category_id');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->foreignUuid('user_id')->change()->constrained('users', 'user_id');
            $table->foreignUuid('post_id')->change()->constrained('posts', 'post_id');
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->foreignUuid('user_id')->change()->constrained('users', 'user_id');
            $table->foreignUuid('post_id')->change()->constrained('posts', 'post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
        });

        Schema::table('interactions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['post_id']);
        });
    }
};
