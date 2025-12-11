<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('courses', function (Blueprint $table) {
      $table->uuid('id')->primary();
      $table->foreignId('author_id')->constrained('users')->onDelete('cascade');
      $table->string('title')->index();
      $table->text('description')->nullable();
      $table->enum('level', ['1', '2', '3'])->default('1');
      $table->decimal('price', 8, 2)->default(0);
      $table->string('image_url')->nullable();
      $table->boolean('public')->default(false);
      $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('courses');
  }
};
