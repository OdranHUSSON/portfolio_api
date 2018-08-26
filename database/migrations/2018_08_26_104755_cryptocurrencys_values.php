<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CryptocurrencysValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrencys_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cryptocurrencys_id')->unsigned();
            $table->foreign('cryptocurrencys_id')->references('id')->on('cryptocurrencys');
            $table->float('usd',16,8);
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
        Schema::dropIfExists('cryptocurrencys_values');
    }
}
