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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // category name
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // user who created the category
            $table->integer('category_level')->default(1); // hierarchy level
            $table->foreignId('parent_category_id')->nullable()->constrained('categories')->onDelete('set null'); // self-referencing parent category
            $table->boolean('is_standard')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
