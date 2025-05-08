<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('subject')->nullable();
            $table->text('certifications')->nullable();
            $table->string('certificate_uploads')->nullable();
            $table->string('certificate_uploads_path')->nullable();
            $table->decimal('fee', 10, 2)->nullable();
            $table->string('location')->nullable();
            $table->text('bio')->nullable();
            $table->string('image')->nullable();
            $table->string('path')->nullable();
            $table->enum('status', ['pending', 'Approved'])->default('pending');



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
        Schema::dropIfExists('instructors');
    }
}
