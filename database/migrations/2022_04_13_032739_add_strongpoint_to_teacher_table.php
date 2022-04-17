<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStrongpointToTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher', function (Blueprint $table) {
            $table->string('nickname')->nullable();
            $table->text('message_admin')->nullable();
            $table->string('beginner')->nullable()->default('times');
            $table->string('exam')->nullable()->default('times');
            $table->string('conversation')->nullable()->default('times');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher', function (Blueprint $table) {
            //
        });
    }
}
