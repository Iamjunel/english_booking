<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_status', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('status')->nullable();
            $table->string('time')->nullable();
            $table->string('comment')->nullable();
            $table->foreignId('company_id')->nullable();
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
        Schema::dropIfExists('company_status');
    }
}
