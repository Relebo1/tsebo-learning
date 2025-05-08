<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('schedules', function (Blueprint $table) {
    $table->id();
    $table->string('subject');
    $table->string('day'); // Change from JSON to a string for individual days
    $table->time('start_time');
    $table->time('end_time');
    $table->string('room_name')->unique();
    $table->unsignedBigInteger('instructor_id');
    $table->timestamps();

    $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
});

}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
