<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	public function up(): void
	{
		Schema::create('enrollments', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained('users')->onDelete('cascade');
			$table->uuid('course_id');
			$table
				->foreign('course_id')
				->references('id')
				->on('courses')
				->onDelete('cascade');
			$table->timestamp('purchased_at')->useCurrent();
			$table->timestamps();

			$table->unique(['user_id', 'course_id']);
		});
	}

	public function down(): void
	{
		Schema::dropIfExists('enrollments');
	}
};
