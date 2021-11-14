<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('full_name', 255)->nullable();
            $table->string('current_city', 255)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('designation', 255)->nullable();
            $table->string('office_name', 255)->nullable();
            $table->string('current_address', 500)->nullable();
            $table->string('permanent_address', 500)->nullable();
            $table->bigInteger('marital_status')->nullable();
            $table->string('spouse_name', 250)->nullable();
            $table->bigInteger('number_of_child')->nullable();
            $table->bigInteger('section')->nullable();
            $table->bigInteger('shift')->nullable();
            $table->bigInteger('religion')->nullable();
            $table->bigInteger('roll_no')->nullable();
            $table->string('attachment')->nullable();         
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
        Schema::dropIfExists('user_details');
    }
}
