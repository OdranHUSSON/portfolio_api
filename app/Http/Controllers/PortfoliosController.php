<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 11:05 AM
 */

namespace App\Http\Controllers;

use App\Portfolios;
use Illuminate\Http\Request;

class PortfoliosController extends Controller
{

    /**
     * @param $portfolioid
     * @return \Illuminate\Http\JsonResponse
     */
    public function get($portfolioid) {
        $portfolio = Portfolios::all()->find($portfolioid);

        $data = [
            "error" => false,
            "name" => $portfolio->name,
            "description" => $portfolio->description
        ];

        $data['cryptocurrencys'] = [];
        foreach($portfolio->portfolios_cryptocurrencys as $cryptocurrency) {
            $data['cryptocurrencys'][$cryptocurrency->cryptocurrencys->symbol] = $cryptocurrency->quantity;
        }

        return response()->json($data);
    }

    /**
     * @param $portfolioid
     * @param $symbol
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPortfolioCryptoCurrency($portfolioid,$symbol) {
        $portfolio = Portfolios::all()->find($portfolioid);
        foreach($portfolio->portfolios_cryptocurrencys as $cryptocurrency) {
            if( $cryptocurrency->cryptocurrencys->symbol = $symbol) {

                return response()->json([
                    "owned" => $cryptocurrency->quantity,
                    "currentValue" => $cryptocurrency->currentValue(),
                    "ChartDataWeekly" => $cryptocurrency->ChartWeeklyData()
                ]);
            }
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function post(Request $request) {
        if(! empty($request->get('name')) && !empty($request->get('description')) && !empty($request->get('user_id')) ) {
            $portfolio = new Portfolios();
            $portfolio->name = $request->get('name');
            $portfolio->description = $request->get('description');
            $portfolio->user_id = $request->get('user_id'); //TODO Replace by auth user
            $portfolio->save();

            return response()->json([
                "error" => false,
                "id" => $portfolio->id,
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