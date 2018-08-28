<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 10:59 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cryptocurrencys extends Model
{
    protected $table = "cryptocurrencys";


    public function Portfolios_cryptocurrencys() {
        return $this->hasMany('App\Portfolios_cryptocurrencys','cryptocurrencys_id');
    }

    public function Cryptocurrencys_values() {
        return $this->hasMany('App\Cryptocurrencys_values','cryptocurrencys_id')->orderBy("created_at","DESC")->latest();
    }
}