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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacherId')->unique();
            $table->string('image')->nullable();
            $table->string('teacherName');
            $table->string('nicNumber');
            $table->string('DoB');
            $table->string('phoneNumber')->unique();
            $table->string('Email')->unique();
            $table->text('homeAddress');
            $table->string('cv');
            $table->string('educationQualification');
            $table->string('experience');
            $table->string('subjects');
            $table->string('teachingLevel');
            $table->string('availability');
            $table->text('bio');
            $table->string('paymentInfo');
            $table->string('handledBy');
            $table->integer('rating');
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
        Schema::dropIfExists('teachers');
    }
};
