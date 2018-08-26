<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 11:00 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Portfolios_cryptocurrencys
{
    protected $table = 'portfolios_cryptocurrencys';

    public function portfolios() {
        return $this->belongsTo("App\Portfolios");
    }

    public function cryptocurrencys() {
        return $this->belongsTo('App\Cryptocurrencys');
    }
}