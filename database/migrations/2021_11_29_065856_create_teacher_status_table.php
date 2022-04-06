<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher_status', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('status')->nullable();
            $table->string('time')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('teacher_id')->nullable();
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
        Schema::dropIfExists('teacher_status');
    }
}
