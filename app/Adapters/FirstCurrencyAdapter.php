<?php

namespace App\Adapters;

use App\Services\FirstCurrencyService;

class FirstCurrencyAdapter implements CurrencyAdapterInterface
{

    protected $firstCurrencyService;

    public function __construct(FirstCurrencyService $firstCurrencyService)
    {
        $this->firstCurrencyService = $firstCurrencyService;
    }

    public function fetchExchangeRates()
    {
        $data = $this->firstCurrencyService->fetch();

        $exchangeRates = [];
        foreach ($data as $currencyData) {
            $exchangeRates['provider_id'] = $this->firstCurrencyService->getProvider()->id;
            $exchangeRates[$currencyData['symbol']] = $currencyData['price'];
        }
        return $exchangeRates;


    }
}



