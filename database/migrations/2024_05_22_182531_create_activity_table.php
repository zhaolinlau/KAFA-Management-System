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
        Schema::create('activity', function (Blueprint $table) {
            $table->id('activityId');
            $table->string('activityName');
            $table->string('activityLocation');
            $table->integer('activityCapacity');
            $table->timestamp('activityDate')->nullable();
            $table->timestamps();
        });
    }

 
};
