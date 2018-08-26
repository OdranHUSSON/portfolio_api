<?php
/**
 * Created by PhpStorm.
 * User: odranhusson
 * Date: 8/26/18
 * Time: 12:49 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cryptocurrencys_values extends Model
{
    protected $table = "cryptocurrencys_values";

    public function cryptocurrencys() {
        return $this->belongsTo('App\Cryptocurrencys');
    }
}