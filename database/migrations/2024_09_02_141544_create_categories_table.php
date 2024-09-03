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
            $table->bigInteger('project_id')->default(0);
            $table->bigInteger('parent_id')->default(0);
            $table->boolean('is_published')->default(0);
            $table->integer('position')->default(0);
            $table->bigInteger('views_count')->default(0);
            $table->string('slug', 255)->unique();
            $table->string('lang', 10);
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->json('options');
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['slug','project_id']);
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
