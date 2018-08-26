<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Portfolio extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('cryptocurrencys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('symbol');
            $table->timestamps();
        });

        DB::table('cryptocurrencys')->insert(
            array(
                'name' => 'Bitcoin',
                'symbol' => 'BTC',
            )
        );

        DB::table('cryptocurrencys')->insert(
            array(
                'name' => 'Ethereum',
                'symbol' => 'ETH',
            )
        );

        DB::table('cryptocurrencys')->insert(
            array(
                'name' => 'Burst',
                'symbol' => 'BURST',
            )
        );

        Schema::create('portfolios_cryptocurrencys', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cryptocurrencys_id')->unsigned();
            $table->foreign('cryptocurrencys_id')->references('id')->on('cryptocurrencys');
            $table->integer('portfolios_id')->unsigned();
            $table->foreign('portfolios_id')->references('id')->on('portfolios');
            $table->float('quantity');
            $table->timestamps();
        });

        Schema::create('users_trade_history', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('cryptocurrencys_id')->unsigned();
            $table->foreign('cryptocurrencys_id')->references('id')->on('cryptocurrencys');
            $table->boolean('isbuying');
            $table->float('quantity');
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
        Schema::dropIfExists('users_trade_history');
        Schema::dropIfExists('portfolios_cryptocurrencys');
        Schema::dropIfExists('cryptocurrencys');
        Schema::dropIfExists('portfolios');
    }
}
