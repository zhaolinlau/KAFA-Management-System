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
		Schema::create('students', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->cascadeOnDelete();
			$table->string('parent_ic_no');
			$table->string('parent_ic');
			$table->string('parent_contact');
			$table->string('relationship');
			$table->string('student_name');
			$table->string('birthday');
			$table->string('birthplace');
			$table->string('permanent_address');
			$table->string('student_ic_no');
			$table->string('student_ic');
			$table->string('student_birthcert');
			$table->string('status')->default('Pending');
			$table->string('matric_no')->default('');
			$table->string('year')->default('');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('students');
	}
};
