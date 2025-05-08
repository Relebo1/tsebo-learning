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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable(); // for student contact number
        $table->string('address')->nullable(); // optional address field
        $table->date('dob')->nullable(); // for date of birth
        $table->string('profile_picture')->nullable(); // profile picture
        $table->string('password');
        $table->enum('status', ['active', 'inactive'])->default('active');
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
