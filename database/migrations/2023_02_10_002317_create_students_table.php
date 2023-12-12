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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('studentId')->unique();
            $table->string('image')->nullable();
            $table->string('studentName');
            $table->string('fatherName');
            $table->string('DoB');
            $table->string('phoneNumber')->unique();
            $table->string('Email')->unique();
            $table->text('homeAddress');
            $table->string('classLevel');
            $table->string('classDuration');
            $table->string('modeOfClass');
            $table->string('subjects');
            $table->string('startDate');
            $table->string('handledBy');
            $table->string('status');
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
        Schema::dropIfExists('students');
    }
};
