<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollectionHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collection_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('committee_id')->nullable();
            $table->integer('member_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->float('amount')->default(0)->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('collection_histories');
    }
}
