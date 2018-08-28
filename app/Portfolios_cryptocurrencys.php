<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 11:00 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Portfolios_cryptocurrencys extends Model
{
    protected $table = 'portfolios_cryptocurrencys';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function portfolios() {
        return $this->belongsTo("App\Portfolios");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cryptocurrencys() {
        return $this->belongsTo('App\Cryptocurrencys');
    }

    /**
     * @return array
     */
    public function CurrentValue() {
        return $this->GetValues(1)[0];
    }

    /**
     * @return array
     */
    public function ChartWeeklyData() {
        $quantity = 1 * 24 * 7;
        return array_reverse($this->GetValues($quantity));
    }

    /**
     * @param $limit
     * @return array
     */
    public function GetValues($limit) {
        $values = $this->cryptocurrencys->Cryptocurrencys_values->take($limit);
        $history = [];
        foreach ($values as $value) {
            $history[] = [
                "date" => $value->created_at->format("d/m/y H:i"),
                "value" => $value->usd * $this->quantity
            ];
        }
        return $history;
    }
}