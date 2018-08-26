<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/25/18
 * Time: 5:05 PM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Portfolios extends Model
{
    protected $table = "portfolios";

    public function portfolios_cryptocurrencys() {
        return $this->hasMany("App\portfolios_cryptocurrencys","portfolios_id");
    }
}