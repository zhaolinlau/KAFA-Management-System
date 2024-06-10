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
        Schema::create('activity_participants', function (Blueprint $table) {
            
            $table->id('participantId');

            $table->string('status');
            $table->timestamps();

            //Foreign key
            $table->unsignedBigInteger('activityId');
            $table->foreign('activityId')->references('activityId')->on('activity');

            $table->unsignedBigInteger('studentsId');
            $table->foreign('studentsId')->references('id')->on('students');

            $table->unsignedBigInteger('usersId');
            $table->foreign('usersId')->references('id')->on('users');

            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_participants');
    }
};
