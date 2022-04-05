<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cid');
            $table->string('cpass');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->string('hp')->nullable();
            $table->text('notes')->nullable();
            $table->string('holidays')->nullable();
            $table->string('pricelist')->nullable();
            $table->enum('has_nursing', ['yes', 'no'])->default('no');
            $table->enum('has_helper', ['yes', 'no'])->default('no');
            $table->enum('has_ventilator', ['yes', 'no'])->default('no');
            $table->enum('has_oxygen', ['yes', 'no'])->default('no');
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
        Schema::dropIfExists('company');
    }
}
