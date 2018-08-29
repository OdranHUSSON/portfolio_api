<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use Illuminate\Support\Facades\Route;

$router->get('/', function () use ($router) {
    return $router->app->version();
});


$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('portfolios/{portfolioid}', 'PortfoliosController@get');
    $router->get('portfolios/{portfolioid}/{symbol}', 'PortfoliosController@getPortfolioCryptoCurrency');
    $router->post('portfolios', ['uses' => 'PortfoliosController@post']);
    $router->post('portfolios/add', ['uses' => 'PortfoliosCryptocurrencysController@post']);


    $router->get('updateDatabase', 'CryptocurrencysValuesController@updateDatabase');
});
