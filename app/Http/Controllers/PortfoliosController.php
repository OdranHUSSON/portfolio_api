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
    public function get(Request $request,$id) {
        $portfolio = Portfolios::all()->find($id);

        $data = [
            "error" => false,
            "name" => $portfolio->name,
            "description" => $portfolio->description
        ];

        foreach($portfolio->portfolios_cryptocurrencys as $cryptocurrency) {
            $data['cryptocurrencys'][$cryptocurrency->cryptocurrencys->symbol] = [
                "quantity" => $cryptocurrency->quantity,
                "ChartDataWeekly" => $cryptocurrency->ChartWeeklyData()
            ];
        }
        return response()->json($data);
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