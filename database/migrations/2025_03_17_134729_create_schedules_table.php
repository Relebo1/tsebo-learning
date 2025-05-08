<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('subject'); // Subject of the class
            $table->string('day'); // Day of the class
            $table->time('start_time'); // Start time of the class
            $table->time('end_time'); // End time of the class
            $table->string('room_name')->unique(); // Room name for the class (unique)
            $table->unsignedBigInteger('instructor_id'); // Foreign key to the instructors table
            $table->timestamps(); // Created at & updated at timestamps

            // Foreign key constraint
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
