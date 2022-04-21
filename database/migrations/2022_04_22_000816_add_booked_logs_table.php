<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBookedLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booked_logs', function (Blueprint $table) {
            //
            $table->increments('id');
            $table->integer('student_id')->nullable();
            $table->integer('teacher_id')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('booked_logs');
    }
}
