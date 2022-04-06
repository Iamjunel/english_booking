<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateBusinessHoursTableDefaultNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher_business_hours', function ($table) {
           
            $table->string('monday_start')->nullable()->change();
            $table->string('monday_end')->nullable()->change();
            $table->string('tuesday_start')->nullable()->change();
            $table->string('tuesday_end')->nullable()->change();
            $table->string('wednesday_start')->nullable()->change();
            $table->string('wednesday_end')->nullable()->change();
            $table->string('thursday_start')->nullable()->change();
            $table->string('thursday_end')->nullable()->change();
            $table->string('friday_start')->nullable()->change();
            $table->string('friday_end')->nullable()->change();
            $table->string('saturday_start')->nullable()->change();
            $table->string('saturday_end')->nullable()->change();
            $table->string('sunday_start')->nullable()->change();
            $table->string('sunday_end')->nullable()->change();
            $table->foreignId('teacher_id')->nullable()->change();

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
    }
}
