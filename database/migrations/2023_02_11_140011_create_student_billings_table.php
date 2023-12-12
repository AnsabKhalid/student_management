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
        Schema::create('student_billings', function (Blueprint $table) {
            $table->id();
            $table->string('studentId');
            $table->string('billId')->unique();
            $table->date('classDate');
            $table->time('classTime');
            $table->string('studentName');
            $table->decimal('payment', 8, 2);
            $table->string('teacherId');
            $table->string('teacherName');
            $table->string('modeOfClass');
            $table->string('classDuration');
            $table->string('subject');
            $table->decimal('teacherPayment', 8, 2);
            $table->enum('status', ['pending', 'paid']);
            $table->enum('attendance', ['pending', 'done']);
            $table->text('message');
            $table->enum('classStatus', ['cancel', 'active']);
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
        Schema::dropIfExists('student_billings');
    }
};
