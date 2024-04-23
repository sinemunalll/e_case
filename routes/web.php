<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/currency-providers/fill', [\App\Http\Controllers\CurrencyProviderController::class, 'fillCurrencyProviders']);

Route::get('/exchange-rate/cheapest', [\App\Http\Controllers\ExchangeRateController::class, 'showCheapestExchangeRate']);
