<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('student', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sid')->nullable();
            $table->string('spass')->nullable();
            $table->string('name')->nullable();
            $table->string('jp_name')->nullable();
            $table->string('eng_name')->nullable();
            $table->string('email')->nullable();
            $table->string('course')->nullable();
            $table->integer('ticket')->nullable()->default(0);
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
        Schema::dropIfExists('student');
    }
}
