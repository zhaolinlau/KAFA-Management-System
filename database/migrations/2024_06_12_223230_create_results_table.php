<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('results', function (Blueprint $table) {
        $table->id('Result_id');
        $table->unsignedBigInteger('id'); // Foreign key linking to students table
        $table->string('Subject_name')->nullable();
        $table->string('Marks')->nullable();
        $table->string('Categories')->nullable();
        $table->string('Grade')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('results');
    }
}