<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;

use App\Portfolios;
use App\Portfolios_cryptocurrencys;
use Illuminate\Http\Request;

class PortfoliosCryptocurrencysController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request) {
        if(! empty($request->get('cryptocurrencys_id')) && !empty($request->get('portfolios_id')) && !empty($request->get('quantity')) ) {
            $Portfolios_cryptocurrencys = new Portfolios_cryptocurrencys();
            $Portfolios_cryptocurrencys->cryptocurrencys_id = $request->get('cryptocurrencys_id');
            $Portfolios_cryptocurrencys->portfolios_id = $request->get('portfolios_id');
            $Portfolios_cryptocurrencys->quantity = $request->get('quantity');
            $Portfolios_cryptocurrencys->save();

            return response()->json([
                "error" => false,
                "id" => $Portfolios_cryptocurrencys->id,
                "message" => "Ok"
            ]);
        }
        else {
            return response()->json([
                "error" => true,
                "message" => "Incomplete data"
            ]);
        }
    }
}