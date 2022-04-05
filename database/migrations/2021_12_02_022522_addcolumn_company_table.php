<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddcolumnCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('company', function ($table) {
            $table->string('call_start')->nullable();
            $table->string('call_end')->nullable();
            $table->string('nursing_status')->default('times');
            $table->string('oxygen_status')->default('times');
            $table->string('ventilator_status')->default('times');
            $table->string('helper_status')->default('times');


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
        Schema::table('company', function ($table) {
            $table->dropColumn('call_start');
            $table->dropColumn('call_end');
            $table->dropColumn('nursing_status');
            $table->dropColumn('oxygen_status');
            $table->dropColumn('ventilator_status');
            $table->dropColumn('helper_status');
        });
    }
}
