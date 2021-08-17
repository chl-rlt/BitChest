<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('price');
            // $table->unsignedBigInteger('date_id')->nullable();
            // $table->foreign('date_id')->references('id')->on('dates');
            $table->dateTimeTz('date');
            $table->unsignedTinyInteger('cryptocurrencie_id')->nullable();
            $table->foreign('cryptocurrencie_id')->references('id')->on('cryptocurrencies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('markets');
    }
}
