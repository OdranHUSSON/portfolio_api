<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 12:30 PM
 */

namespace App\Http\Controllers;


use App\Cryptocurrencys;
use App\Cryptocurrencys_values;

class CryptocurrencysValuesController extends Controller
{

    public function updateDatabase() {
        $cryptocurrencys = Cryptocurrencys::all();
        $symbols = [];
        foreach ($cryptocurrencys as $cryptocurrency) {
            $symbols[$cryptocurrency->symbol] = 1;
        }
        $symbols = $this->getValues($symbols);

        foreach ($cryptocurrencys as $cryptocurrency) {
            if($symbols[$cryptocurrency->symbol] != 0) {
                $Cryptocurrencys_values = new Cryptocurrencys_values();
                $Cryptocurrencys_values->cryptocurrencys_id = $cryptocurrency->id;
                $Cryptocurrencys_values->usd = $symbols[$cryptocurrency->symbol];
                $Cryptocurrencys_values->save();
            }
        }
        return response()->json("Done");
    }


    /**
     * @param array $symbols
     * @return array
     */
    public function getValues($symbols) {
        return $this->getValuesFromPoloniex($symbols);
    }

    /**
     * array[symbol] = quantity to multiply by
     * @param array $symbols
     * @return array
     */
    protected function getValuesFromPoloniex($symbols) {
        $ticker_data = file_get_contents("https://poloniex.com/public?command=returnTicker");
        $ticker_data = json_decode($ticker_data, true);
        foreach ($symbols as $symbol => $qt) {
            if($symbol == "BTC") {
                $symbols[$symbol] = $qt * $ticker_data["USDT_BTC"]["last"];
            }
            else {
                $symbols[$symbol] = $qt * $ticker_data["BTC_" . $symbol]["last"] * $ticker_data["USDT_BTC"]["last"];
            }
        }

        return $symbols;
    }
}